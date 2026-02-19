# API Nmess

## Токен (Laravel)

**GET /api/nmess/token** (требуется авторизация)

Ответ:
```json
{
  "token": "строка-токен",
  "user_id": "1"
}
```

Клиент передаёт токен при подключении к WebSocket: `ws://host:port?token=...`

## Сервер сигналинга (WebSocket)

Подключение: `ws://localhost:3001?token=<token>` (или wss в продакшене).

Сообщения — JSON с полем `type`.

- **join** — войти в комнату: `{ "type": "join", "roomId": "room-1" }`
- **leave** — выйти: `{ "type": "leave", "roomId": "room-1" }`
- **offer** / **answer** / **ice_candidate** — для WebRTC: `{ "type": "...", "roomId": "...", "to": "userId", ... }`

Сервер отправляет:
- **authenticated** — после успешной проверки токена
- **error** — ошибка (например, `{ "type": "error", "message": "..." }`)
- **joined** — подтверждение входа в комнату
- **peer_joined** / **peer_left** — уведомления об участниках
- **pong** — ответ на **ping**
