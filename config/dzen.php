<?php

return [

    /*
    | Канал Дзен для ленты новостей на главной.
    | URL канала: https://dzen.ru/digital_fintech
    | В API передаётся channel_name (slug или URL). Опционально channel_id (см. ниже).
    */
    'channel_url' => env('DZEN_CHANNEL_URL', 'https://dzen.ru/digital_fintech'),

    /*
    | Опциональный ID канала (например 5a3287185f4967644f9226e4).
    | Если dzen.ru возвращает 404/пустой items, укажите channel_id из zen.yandex.ru/id/CHANNEL_ID.
    */
    'channel_id' => env('DZEN_CHANNEL_ID', null),

    /*
    | Базовый URL API (неофициальный). Используется первым; при пустом items пробуются другие хосты.
    */
    'api_url' => env('DZEN_API_URL', 'https://dzen.ru/api/v3/launcher/more'),

    /*
    | Дополнительные URL API для перебора, если основной возвращает пустой items.
    | По умолчанию пробуются zen.yandex.com и zen.yandex.ru.
    */
    'api_url_fallbacks' => [
        'https://zen.yandex.com/api/v3/launcher/more',
        'https://zen.yandex.ru/api/v3/launcher/more',
    ],

];
