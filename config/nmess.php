<?php

return [
    /*
    | URL сервера сигналинга (WebSocket). Клиент подключается по этому адресу.
    */
    'ws_url' => env('NMESS_WS_URL', 'ws://127.0.0.1:3001'),
];
