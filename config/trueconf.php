<?php

return [
    /*
    | Базовый URL TrueConf Server (API и веб-клиент).
    */
    'base_url' => rtrim(env('TRUECONF_BASE_URL', 'https://mess.nexus-invest.fund'), '/'),

    /*
    | OAuth 2.0: Application ID (client_id) и Secret из панели API → OAuth2.
    */
    'client_id' => env('TRUECONF_CLIENT_ID', ''),
    'client_secret' => env('TRUECONF_CLIENT_SECRET', ''),

    /*
    | URL переадресации для метода Authorization Code (если используется).
    */
    'redirect_uri' => env('TRUECONF_REDIRECT_URI', ''),

    /*
    | Версия API (путь вида /api/v3.8).
    */
    'api_version' => env('TRUECONF_API_VERSION', 'v3.8'),

    /*
    | Проверять SSL при запросах к TrueConf (false только для локальной разработки при cURL error 60).
    */
    'verify_ssl' => env('TRUECONF_VERIFY_SSL', true),
];
