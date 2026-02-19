/**
 * Nmess — сервер сигналинга для мессенджера НЕКСУС.
 * WebSocket: обмен SDP и ICE для WebRTC; аутентификация по токену.
 */

const http = require('http');
const { WebSocketServer } = require('ws');

const PORT = parseInt(process.env.PORT || '3001', 10);

const server = http.createServer((req, res) => {
  res.writeHead(200, { 'Content-Type': 'text/plain' });
  res.end('Nmess signaling server');
});

const wss = new WebSocketServer({ server });

/** Текущие подключения: ws -> { userId, token } */
const clients = new Map();

/** userId -> ws (последнее подключение по userId) */
const userIdToWs = new Map();

/** Комнаты для звонков: roomId -> Set<ws> */
const rooms = new Map();

/**
 * Упрощённая проверка токена (заглушка).
 * В продакшене: проверить JWT или запрос к Laravel API.
 */
function validateToken(token) {
  if (!token || typeof token !== 'string') return null;
  // Заглушка: считаем токен валидным, userId = хэш от токена для теста
  if (process.env.JWT_SECRET) {
    // TODO: проверить JWT через jsonwebtoken и вернуть userId из payload
    return 'user-' + token.slice(0, 8);
  }
  return 'user-' + token.slice(0, 8);
}

function send(ws, type, payload) {
  if (ws.readyState !== 1) return;
  ws.send(JSON.stringify({ type, ...payload }));
}

function broadcastToRoom(roomId, type, payload, excludeWs = null) {
  const room = rooms.get(roomId);
  if (!room) return;
  room.forEach((ws) => {
    if (ws !== excludeWs) send(ws, type, payload);
  });
}

wss.on('connection', (ws, req) => {
  const url = new URL(req.url || '', 'http://localhost');
  const token = url.searchParams.get('token');

  const userId = validateToken(token);
  if (!userId) {
    send(ws, 'error', { message: 'Недействительный токен. Выполните вход снова.' });
    ws.close(4001, 'Unauthorized');
    return;
  }

  const meta = { userId, token };
  clients.set(ws, meta);
  send(ws, 'authenticated', { userId });

  ws.on('message', (raw) => {
    try {
      const msg = JSON.parse(raw.toString());
      if (!meta) return;

      switch (msg.type) {
        case 'set_user_id':
          if (msg.user_id) {
            if (meta.userId) userIdToWs.delete(meta.userId);
            meta.userId = String(msg.user_id);
            userIdToWs.set(meta.userId, ws);
            send(ws, 'user_id_set', { userId: meta.userId });
          }
          break;

        case 'ping':
          send(ws, 'pong', {});
          break;

        case 'join':
          if (!msg.roomId) {
            send(ws, 'error', { message: 'Укажите комнату.' });
            break;
          }
          if (!rooms.has(msg.roomId)) rooms.set(msg.roomId, new Set());
          rooms.get(msg.roomId).add(ws);
          send(ws, 'joined', { roomId: msg.roomId });
          broadcastToRoom(msg.roomId, 'peer_joined', { userId: meta.userId }, ws);
          break;

        case 'leave':
          if (msg.roomId && rooms.has(msg.roomId)) {
            rooms.get(msg.roomId).delete(ws);
            broadcastToRoom(msg.roomId, 'peer_left', { userId: meta.userId }, ws);
            if (rooms.get(msg.roomId).size === 0) rooms.delete(msg.roomId);
          }
          break;

        case 'call_request':
          if (!msg.to || !msg.roomId) {
            send(ws, 'error', { message: 'Укажите to и roomId.' });
            break;
          }
          const targetWs = userIdToWs.get(String(msg.to));
          if (!targetWs || targetWs.readyState !== 1) {
            send(ws, 'error', { message: 'Пользователь недоступен.' });
            break;
          }
          send(targetWs, 'incoming_call', {
            from: meta.userId,
            fromName: msg.fromName || meta.userId,
            roomId: msg.roomId,
          });
          break;

        case 'call_accept':
          if (!msg.roomId || !msg.from) break;
          const callerWs = userIdToWs.get(String(msg.from));
          if (callerWs && callerWs.readyState === 1) {
            send(callerWs, 'call_accepted', { roomId: msg.roomId, userId: meta.userId });
          }
          break;

        case 'call_reject':
          if (!msg.roomId || !msg.from) break;
          const cw = userIdToWs.get(String(msg.from));
          if (cw && cw.readyState === 1) {
            send(cw, 'call_rejected', { roomId: msg.roomId, userId: meta.userId });
          }
          break;

        case 'chat_message': {
          if (!msg.roomId || typeof msg.text !== 'string') {
            send(ws, 'error', { message: 'Укажите roomId и text.' });
            break;
          }
          const text = msg.text.trim().slice(0, 4096);
          const payload = {
            roomId: msg.roomId,
            from: meta.userId,
            fromName: msg.fromName || meta.userId,
            text,
          };
          const parts = msg.roomId.replace(/^chat-/, '').split('-');
          const otherId = parts.find((id) => id !== meta.userId);
          if (otherId) {
            const otherWs = userIdToWs.get(otherId);
            if (otherWs && otherWs.readyState === 1 && otherWs !== ws) {
              send(otherWs, 'chat_message', payload);
            }
          }
          break;
        }

        case 'offer':
        case 'answer':
        case 'ice_candidate':
          if (msg.to && msg.roomId) {
            const room = rooms.get(msg.roomId);
            if (room) {
              room.forEach((peer) => {
                const peerMeta = clients.get(peer);
                if (peerMeta && peerMeta.userId === msg.to) {
                  send(peer, msg.type, {
                    from: meta.userId,
                    ...(msg.payload || msg),
                  });
                }
              });
            }
          }
          break;

        default:
          send(ws, 'error', { message: 'Неизвестный тип сообщения.' });
      }
    } catch (e) {
      send(ws, 'error', { message: 'Ошибка формата сообщения.' });
    }
  });

  ws.on('close', () => {
    if (meta.userId) userIdToWs.delete(meta.userId);
    clients.delete(ws);
    rooms.forEach((set, roomId) => {
      if (set.has(ws)) {
        set.delete(ws);
        broadcastToRoom(roomId, 'peer_left', { userId: meta?.userId }, null);
        if (set.size === 0) rooms.delete(roomId);
      }
    });
  });
});

server.listen(PORT, () => {
  console.log(`Nmess signaling server listening on port ${PORT}`);
});
