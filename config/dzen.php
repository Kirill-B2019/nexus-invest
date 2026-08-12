<?php

return [

    /*
    | Канал Дзен для ленты новостей на главной.
    | URL канала: https://dzen.ru/digital_fintech
    | В API передаётся channel_name (slug или URL). Опционально channel_id (см. ниже).
    */
    'channel_url' => env('DZEN_CHANNEL_URL', 'https://dzen.ru/digital_fintech'),

    /*
    | ID канала (publisher_id). Для digital_fintech — 5c3757f470c93f00a9a95047.
    | Используется как запасной параметр channel_id, если channel_name не сработал.
    */
    'channel_id' => env('DZEN_CHANNEL_ID', '5c3757f470c93f00a9a95047'),

    /*
    | Базовый URL API (неофициальный). export отдаёт ленту канала; more часто возвращает пустой items.
    */
    'api_url' => env('DZEN_API_URL', 'https://dzen.ru/api/v3/launcher/export'),

    /*
    | Дополнительные URL API для перебора, если основной возвращает пустой items.
    */
    'api_url_fallbacks' => [
        'https://zen.yandex.ru/api/v3/launcher/export',
        'https://zen.yandex.com/api/v3/launcher/export',
        'https://dzen.ru/api/v3/launcher/more',
        'https://zen.yandex.ru/api/v3/launcher/more',
    ],

    /*
    | Общие query-параметры для запросов к API Дзен.
    */
    'api_query' => [
        'clid' => 1400,
        'country_code' => 'ru',
        'lang' => 'ru',
    ],

];
