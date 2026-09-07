<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Источники новостной ленты
    |--------------------------------------------------------------------------
    */
    'sources' => [
        'dzen' => [
            'enabled' => true,
            'label' => 'Дзен',
        ],
        'agency' => [
            'enabled' => env('NEWS_AGENCY_ENABLED', false),
            'label' => 'Информагентство',
            'api_url' => env('NEWS_AGENCY_API_URL'),
            'token' => env('NEWS_AGENCY_TOKEN'),
        ],
    ],

];
