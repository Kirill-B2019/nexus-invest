<template>
  <div class="nmess-app">
    <header class="nmess-header">
      <img :src="logoSrc" alt="НЕКСУС" class="nmess-logo" />
      <span class="nmess-title">Мессенджер</span>
      <span v-if="userId" class="nmess-user">{{ userName || userId }}</span>
      <span v-else-if="error" class="nmess-error">{{ error }}</span>
      <span v-else class="nmess-status">Загрузка…</span>
    </header>
    <main class="nmess-main">
      <aside class="nmess-sidebar nmess-card">
        <h2 class="nmess-sidebar-title">Контакты</h2>
        <p v-if="!userId" class="nmess-muted">Войдите в систему НЕКСУС и откройте мессенджер из личного кабинета.</p>
        <template v-else>
          <p v-if="contacts.length === 0 && !contactsLoading" class="nmess-muted">Нет контактов</p>
          <ul v-else class="nmess-chat-list">
            <li v-for="c in contacts" :key="c.id" class="nmess-list-item nmess-border-accent">
              <span class="nmess-contact-name">{{ c.name || c.email }}</span>
              <div class="nmess-contact-actions">
                <button type="button" class="nmess-btn-chat" @click="openChat(c)" :disabled="!wsConnected">
                  {{ wsConnected ? 'Написать' : '—' }}
                </button>
                <button type="button" class="nmess-btn-primary nmess-btn-call" @click="startCall(c)" :disabled="!wsConnected">
                  {{ wsConnected ? 'Позвонить' : 'Нет связи' }}
                </button>
              </div>
            </li>
          </ul>
        </template>
        <p v-if="userId" class="nmess-status-small">Сигналинг: {{ wsConnected ? 'подключено' : 'нет' }}</p>
      </aside>
      <section class="nmess-chat nmess-card">
        <p v-if="!activeChatContact && !incomingCall" class="nmess-muted">Выберите контакт: нажмите «Написать» для чата или «Позвонить» для голосового звонка.</p>
        <template v-else-if="activeChatContact && callState">
          <div class="nmess-call-panel">
            <p class="nmess-call-title">
              {{ callState === 'calling' ? 'Звонок…' : 'Разговор' }} с {{ activeChatContact.name || activeChatContact.email }}
            </p>
            <audio ref="remoteAudioEl" autoplay playsinline></audio>
            <p v-if="callError" class="nmess-error">{{ callError }}</p>
            <button type="button" class="nmess-btn-reject" @click="hangUp">Завершить звонок</button>
          </div>
        </template>
        <template v-else-if="activeChatContact">
          <div class="nmess-chat-head">
            <span class="nmess-chat-title">Чат с {{ activeChatContact.name || activeChatContact.email }}</span>
            <button type="button" class="nmess-btn-back" @click="closeChat">← Назад</button>
          </div>
          <div class="nmess-messages" ref="messagesEl">
            <div v-for="(m, i) in chatMessages" :key="i" :class="['nmess-msg', m.isOwn ? 'nmess-msg-own' : 'nmess-msg-them']">
              <span v-if="!m.isOwn" class="nmess-msg-author">{{ m.fromName }}</span>
              <span class="nmess-msg-text">{{ m.text }}</span>
            </div>
          </div>
          <form class="nmess-send-form" @submit.prevent="sendMessage">
            <input v-model="messageDraft" type="text" class="nmess-input" placeholder="Сообщение..." maxlength="4096" />
            <button type="submit" class="nmess-btn-primary" :disabled="!messageDraft.trim() || !wsConnected">Отправить</button>
          </form>
        </template>
      </section>
    </main>
    <!-- Входящий звонок -->
    <div v-if="incomingCall" class="nmess-incoming-overlay">
      <div class="nmess-incoming-card nmess-card">
        <p class="nmess-incoming-title">Входящий звонок</p>
        <p class="nmess-incoming-from">{{ incomingCall.fromName || incomingCall.from }}</p>
        <div class="nmess-incoming-actions">
          <button type="button" class="nmess-btn-primary" @click="acceptCall">Принять</button>
          <button type="button" class="nmess-btn-reject" @click="rejectCall">Отклонить</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue';

const userId = ref('');
const userName = ref('');
const error = ref('');
const wsConnected = ref(false);
const contacts = ref([]);
const contactsLoading = ref(false);
const wsRef = ref(null);
const activeChatContact = ref(null);
const callState = ref('');
const chatRoomId = ref('');
const chatMessages = ref([]);
/** Сообщения по комнатам (roomId -> массив), чтобы показывать при открытии чата и фильтровать входящие */
const messagesByRoom = ref({});
const messageDraft = ref('');
const messagesEl = ref(null);
const incomingCall = ref(null);
const logoSrc = import.meta.env.BASE_URL + 'logo-head.svg';
const callRoomId = ref('');
const peerConnection = ref(null);
const localStream = ref(null);
const remoteAudioEl = ref(null);
const callError = ref('');

function wsSend(obj) {
  const ws = wsRef.value;
  if (ws && ws.readyState === 1) ws.send(JSON.stringify(obj));
}

async function loadContacts() {
  contactsLoading.value = true;
  try {
    const res = await fetch('/api/nmess/contacts', { credentials: 'include' });
    if (res.ok) {
      const data = await res.json();
      contacts.value = data.contacts || [];
    }
  } finally {
    contactsLoading.value = false;
  }
}

function openChat(contact) {
  if (!wsRef.value || wsRef.value.readyState !== 1) return;
  callState.value = '';
  const roomId = 'chat-' + [userId.value, contact.id].sort().join('-');
  chatRoomId.value = roomId;
  chatMessages.value = [...(messagesByRoom.value[roomId] || [])];
  activeChatContact.value = contact;
  wsSend({ type: 'join', roomId });
}

function closeChat() {
  if (chatRoomId.value) {
    wsSend({ type: 'leave', roomId: chatRoomId.value });
    chatRoomId.value = '';
  }
  activeChatContact.value = null;
  chatMessages.value = [];
  callState.value = '';
}

function sendMessage() {
  const text = messageDraft.value.trim();
  if (!text || !chatRoomId.value || !wsRef.value || wsRef.value.readyState !== 1) return;
  wsSend({
    type: 'chat_message',
    roomId: chatRoomId.value,
    text,
    fromName: userName.value || userId.value,
  });
  const ownMsg = { from: userId.value, fromName: userName.value || userId.value, text, isOwn: true };
  chatMessages.value.push(ownMsg);
  const r = chatRoomId.value;
  if (!messagesByRoom.value[r]) messagesByRoom.value[r] = [];
  messagesByRoom.value[r] = [...(messagesByRoom.value[r] || []), ownMsg];
  messageDraft.value = '';
  nextTick(() => {
    if (messagesEl.value) messagesEl.value.scrollTop = messagesEl.value.scrollHeight;
  });
}

const ICE_SERVERS = [{ urls: 'stun:stun.l.google.com:19302' }];

function getPeerUserId() {
  const c = activeChatContact.value;
  return c ? String(c.id) : '';
}

async function startCall(contact) {
  if (!wsRef.value || wsRef.value.readyState !== 1) return;
  callError.value = '';
  const roomId = 'call-' + [userId.value, contact.id].sort().join('-');
  callRoomId.value = roomId;
  wsSend({ type: 'join', roomId });
  wsSend({
    type: 'call_request',
    to: contact.id,
    roomId,
    fromName: userName.value || userId.value,
  });
  activeChatContact.value = contact;
  callState.value = 'calling';
}

async function startWebRTCAsCaller() {
  const peerId = getPeerUserId();
  const roomId = callRoomId.value;
  if (!peerId || !roomId) return;
  try {
    const stream = await navigator.mediaDevices.getUserMedia({ audio: true, video: false });
    localStream.value = stream;
    const pc = new RTCPeerConnection({ iceServers: ICE_SERVERS });
    peerConnection.value = pc;
    stream.getTracks().forEach((track) => pc.addTrack(track, stream));
    pc.ontrack = (e) => {
      if (remoteAudioEl.value && e.streams[0]) {
        remoteAudioEl.value.srcObject = e.streams[0];
      }
    };
    pc.onicecandidate = (e) => {
      if (e.candidate) wsSend({ type: 'ice_candidate', to: peerId, roomId, payload: { candidate: e.candidate } });
    };
    const offer = await pc.createOffer();
    await pc.setLocalDescription(offer);
    wsSend({ type: 'offer', to: peerId, roomId, payload: { sdp: pc.localDescription } });
  } catch (err) {
    callError.value = 'Не удалось получить доступ к микрофону.';
    console.error(err);
  }
}

async function startWebRTCAsCallee(offerSdp) {
  const peerId = getPeerUserId();
  const roomId = callRoomId.value;
  if (!peerId || !roomId) return;
  try {
    const stream = await navigator.mediaDevices.getUserMedia({ audio: true, video: false });
    localStream.value = stream;
    const pc = new RTCPeerConnection({ iceServers: ICE_SERVERS });
    peerConnection.value = pc;
    stream.getTracks().forEach((track) => pc.addTrack(track, stream));
    pc.ontrack = (e) => {
      if (remoteAudioEl.value && e.streams[0]) {
        remoteAudioEl.value.srcObject = e.streams[0];
      }
    };
    pc.onicecandidate = (e) => {
      if (e.candidate) wsSend({ type: 'ice_candidate', to: peerId, roomId, payload: { candidate: e.candidate } });
    };
    await pc.setRemoteDescription(new RTCSessionDescription(offerSdp));
    const answer = await pc.createAnswer();
    await pc.setLocalDescription(answer);
    wsSend({ type: 'answer', to: peerId, roomId, payload: { sdp: pc.localDescription } });
  } catch (err) {
    callError.value = 'Ошибка подключения голоса.';
    console.error(err);
  }
}

function hangUp() {
  const roomId = callRoomId.value;
  if (peerConnection.value) {
    peerConnection.value.close();
    peerConnection.value = null;
  }
  if (localStream.value) {
    localStream.value.getTracks().forEach((t) => t.stop());
    localStream.value = null;
  }
  if (roomId) wsSend({ type: 'leave', roomId });
  callRoomId.value = '';
  callState.value = '';
  activeChatContact.value = null;
  callError.value = '';
}

function acceptCall() {
  if (!incomingCall.value) return;
  const { from, roomId } = incomingCall.value;
  callRoomId.value = roomId;
  callError.value = '';
  wsSend({ type: 'join', roomId });
  wsSend({ type: 'call_accept', from, roomId });
  activeChatContact.value = { id: from, name: incomingCall.value.fromName, email: '' };
  callState.value = 'in_call';
  incomingCall.value = null;
}

function rejectCall() {
  if (!incomingCall.value) return;
  wsSend({ type: 'call_reject', from: incomingCall.value.from, roomId: incomingCall.value.roomId });
  incomingCall.value = null;
}

onMounted(async () => {
  try {
    const res = await fetch('/api/nmess/token', { credentials: 'include' });
    if (!res.ok) {
      error.value = 'Нет доступа к мессенджеру. Обратитесь к администратору.';
      return;
    }
    const data = await res.json();
    userId.value = data.user_id || data.userId || 'user';
    userName.value = data.name || '';
    loadContacts();

    const token = data.token;
    if (token) {
      let wsUrl = data.ws_url;
      if (!wsUrl) {
        const scheme = location.protocol === 'https:' ? 'wss:' : 'ws:';
        const host = (location.hostname === 'localhost' || location.hostname === '127.0.0.1')
          ? location.hostname + ':3001' : location.host;
        wsUrl = `${scheme}//${host}`;
      }
      if (!wsUrl.startsWith('ws')) wsUrl = (location.protocol === 'https:' ? 'wss:' : 'ws:') + '//' + wsUrl.replace(/^https?:\/\//, '');
      const ws = new WebSocket(`${wsUrl}?token=${encodeURIComponent(token)}`);
      wsRef.value = ws;

      ws.onopen = () => {
        wsConnected.value = true;
        ws.send(JSON.stringify({ type: 'set_user_id', user_id: userId.value }));
      };
      ws.onclose = () => { wsConnected.value = false; };
      ws.onmessage = (e) => {
        try {
          const msg = JSON.parse(e.data);
          if (msg.type === 'error') error.value = msg.message || 'Ошибка сервера';
          if (msg.type === 'incoming_call') incomingCall.value = { from: msg.from, fromName: msg.fromName, roomId: msg.roomId };
          if (msg.type === 'call_accepted') {
            callState.value = 'in_call';
            startWebRTCAsCaller();
          }
          if (msg.type === 'offer') {
            startWebRTCAsCallee(msg.sdp || msg);
          }
          if (msg.type === 'answer' && peerConnection.value) {
            peerConnection.value.setRemoteDescription(new RTCSessionDescription(msg.sdp || msg)).catch((e) => {
              callError.value = 'Ошибка подключения.';
              console.error(e);
            });
          }
          if (msg.type === 'ice_candidate' && peerConnection.value && (msg.candidate || msg.payload?.candidate)) {
            const cand = msg.candidate || msg.payload?.candidate;
            peerConnection.value.addIceCandidate(new RTCIceCandidate(cand)).catch((e) => console.error(e));
          }
          if (msg.type === 'call_rejected') {
            if (peerConnection.value) {
              peerConnection.value.close();
              peerConnection.value = null;
            }
            if (localStream.value) {
              localStream.value.getTracks().forEach((t) => t.stop());
              localStream.value = null;
            }
            callRoomId.value = '';
            activeChatContact.value = null;
            callState.value = '';
            error.value = 'Звонок отклонён';
          }
          if (msg.type === 'chat_message') {
            const r = msg.roomId || chatRoomId.value;
            const m = {
              from: msg.from,
              fromName: msg.fromName || msg.from,
              text: msg.text,
              isOwn: false,
            };
            messagesByRoom.value[r] = [...(messagesByRoom.value[r] || []), m];
            if (r === chatRoomId.value) {
              chatMessages.value.push(m);
              nextTick(() => {
                if (messagesEl.value) messagesEl.value.scrollTop = messagesEl.value.scrollHeight;
              });
            }
          }
        } catch (_) {}
      };
    }
  } catch (e) {
    error.value = 'Не удалось загрузить сессию. Выполните вход в НЕКСУС.';
  }
});
</script>

<style scoped>
.nmess-app {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}
.nmess-header {
  display: flex;
  align-items: center;
  gap: 16px;
  padding: 12px 20px;
}
.nmess-logo {
  height: 28px;
  width: auto;
  max-width: 120px;
  object-fit: contain;
}
.nmess-title {
  font-weight: 600;
  color: var(--color-primary);
}
.nmess-user {
  margin-left: auto;
  font-size: 0.9rem;
  color: var(--color-text-muted-4);
}
.nmess-error {
  margin-left: auto;
  font-size: 0.85rem;
  color: #e57373;
}
.nmess-status {
  margin-left: auto;
  font-size: 0.9rem;
  color: var(--color-text-muted-4);
}
.nmess-main {
  flex: 1;
  display: grid;
  grid-template-columns: 280px 1fr;
  gap: 20px;
  padding: 20px;
  max-width: 1200px;
  margin: 0 auto;
}
@media (max-width: 768px) {
  .nmess-main { grid-template-columns: 1fr; }
}
.nmess-sidebar {
  padding: 16px;
}
.nmess-sidebar-title {
  margin: 0 0 12px;
  font-size: 1.1rem;
  color: var(--color-surface-light);
}
.nmess-chat-list {
  list-style: none;
  margin: 0;
  padding: 0;
}
.nmess-list-item {
  padding: 10px 12px;
  margin-bottom: 8px;
  border-radius: 8px;
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.nmess-contact-name {
  font-weight: 500;
}
.nmess-contact-actions {
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
}
.nmess-btn-chat {
  padding: 6px 12px;
  font-size: 0.9rem;
  background: var(--color-surface-dark-2);
  color: var(--color-surface-light);
  border: 1px solid var(--color-text-muted-8);
  border-radius: 8px;
  cursor: pointer;
  font-family: inherit;
}
.nmess-btn-chat:hover:not(:disabled) {
  background: var(--color-text-muted-8);
}
.nmess-btn-chat:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}
.nmess-btn-call {
  padding: 6px 12px;
  font-size: 0.9rem;
}
.nmess-btn-call:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}
.nmess-chat {
  padding: 20px;
  display: flex;
  flex-direction: column;
  min-height: 200px;
}
.nmess-chat-head {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 12px;
}
.nmess-chat-title {
  font-weight: 600;
  color: var(--color-primary);
}
.nmess-btn-back {
  padding: 6px 10px;
  font-size: 0.85rem;
  background: transparent;
  color: var(--color-text-muted-4);
  border: 1px solid var(--color-text-muted-8);
  border-radius: 8px;
  cursor: pointer;
  font-family: inherit;
}
.nmess-btn-back:hover {
  background: var(--color-surface-dark-2);
}
.nmess-messages {
  flex: 1;
  overflow-y: auto;
  min-height: 120px;
  max-height: 280px;
  padding: 12px 0;
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.nmess-msg {
  padding: 8px 12px;
  border-radius: 8px;
  max-width: 85%;
}
.nmess-msg-them {
  align-self: flex-start;
  background: var(--color-surface-dark-2);
  border: 1px solid var(--color-text-muted-8);
}
.nmess-msg-own {
  align-self: flex-end;
  background: var(--color-primary);
  color: #fff;
}
.nmess-msg-author {
  display: block;
  font-size: 0.8rem;
  color: var(--color-text-muted-5);
  margin-bottom: 2px;
}
.nmess-msg-text {
  white-space: pre-wrap;
  word-break: break-word;
}
.nmess-send-form {
  display: flex;
  gap: 10px;
  margin-top: 12px;
}
.nmess-input {
  flex: 1;
  padding: 10px 14px;
  border-radius: 8px;
  border: 1px solid var(--color-text-muted-8);
  background: var(--color-surface-dark-2);
  color: var(--color-surface-light);
  font-size: 1rem;
  font-family: inherit;
}
.nmess-input::placeholder {
  color: var(--color-text-muted-5);
}
.nmess-muted {
  color: var(--color-text-muted-4);
  font-size: 0.95rem;
}
.nmess-status-small {
  margin-top: 12px;
  font-size: 0.85rem;
  color: var(--color-text-muted-5);
}
.nmess-call-panel {
  padding: 16px 0;
}
.nmess-call-title {
  margin: 0 0 16px;
  font-weight: 600;
  color: var(--color-primary);
}
.nmess-call-panel .nmess-btn-reject {
  margin-top: 8px;
}
.nmess-incoming-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.6);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
}
.nmess-incoming-card {
  padding: 24px;
  min-width: 280px;
}
.nmess-incoming-title {
  margin: 0 0 8px;
  font-size: 1rem;
  color: var(--color-text-muted-4);
}
.nmess-incoming-from {
  margin: 0 0 20px;
  font-size: 1.25rem;
  font-weight: 600;
  color: var(--color-primary);
}
.nmess-incoming-actions {
  display: flex;
  gap: 12px;
}
.nmess-btn-reject {
  background: var(--color-surface-dark-2);
  color: var(--color-surface-light);
  border: 1px solid var(--color-text-muted-8);
  padding: 10px 20px;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  font-family: inherit;
}
.nmess-btn-reject:hover {
  background: var(--color-text-muted-8);
}
</style>
