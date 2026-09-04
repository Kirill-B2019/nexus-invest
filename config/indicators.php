<?php

/**
 * Конфигурация публичных отраслевых индикаторов ЦФА/RWA.
 */
return [

    'cache_ttl' => (int) env('INDICATORS_CACHE_TTL', 300),

    'sources' => [
        'ncr' => [
            'name' => 'НКР',
            'url' => 'https://ratings.ru/files/research/NCR_CFA_2026.pdf',
            'update_frequency' => 'quarterly',
        ],
        'procfa' => [
            'name' => 'цфа.рф',
            'url' => 'https://procfa.ru/',
            'update_frequency' => 'monthly',
        ],
        'smartlab' => [
            'name' => 'Smart-Lab',
            'url' => 'https://smart-lab.ru/blog/news/1347551.php',
            'update_frequency' => 'event',
        ],
        'coinshares' => [
            'name' => 'CoinShares',
            'url' => 'https://crypto.news/rwa-deposits-triple-to-7-4b-as-defi-activity-falls/',
            'update_frequency' => 'quarterly',
        ],
        'rwa_xyz' => [
            'name' => 'RWA.xyz',
            'url' => 'https://app.rwa.xyz/',
            'update_frequency' => 'monthly',
        ],
        'cbr' => [
            'name' => 'Банк России',
            'url' => 'https://cbr.ru/',
            'update_frequency' => 'quarterly',
        ],
        'nexus' => [
            'name' => 'Внутренняя статистика НЕКСУС',
            'url' => null,
            'update_frequency' => 'quarterly',
        ],
    ],

    /**
     * Индикаторы: период обновления и связанные источники.
     * Снимки хранятся в таблицах; API читает только из БД.
     */
    'indicators' => [
        'cfa-temperature' => [
            'name' => 'Температура рынка ЦФА в России',
            'update_frequency' => 'monthly',
            'table' => 'cfa_market_ru',
            'sources' => ['ncr', 'procfa', 'cbr'],
            'parsers' => ['procfa', 'ncr'],
        ],
        'liquidity-light' => [
            'name' => 'Ликвидность вторички ЦФА в РФ',
            'update_frequency' => 'quarterly',
            'table' => 'cfa_market_ru',
            'sources' => ['ncr', 'procfa', 'cbr'],
            'parsers' => ['ncr', 'procfa'],
        ],
        'rwa-vs-defi' => [
            'name' => 'RWA vs DeFi : сдвиг капитала',
            'update_frequency' => 'quarterly',
            'table' => 'rwa_global',
            'sources' => ['coinshares'],
            'parsers' => ['coinshares'],
        ],
        'rwa-global' => [
            'name' => 'Глобальный RWA‑трекер',
            'update_frequency' => 'monthly',
            'table' => 'rwa_global',
            'sources' => ['rwa_xyz', 'coinshares'],
            'parsers' => ['rwa_xyz'],
        ],
        'sme-cost' => [
            'name' => 'Стоимость привлечения капитала для SME в РФ',
            'update_frequency' => 'quarterly',
            'table' => 'sme_finance',
            'sources' => ['cbr', 'nexus'],
            'parsers' => [],
        ],
        'risk-map' => [
            'name' => 'Риск‑ландшафт ЦФА',
            'update_frequency' => 'semiannual',
            'table' => 'cfa_risks',
            'sources' => ['ncr', 'smartlab', 'cbr'],
            'parsers' => ['ncr'],
        ],
    ],

    'cfa_temp_weights' => [
        'placement' => 0.35,
        'secondary' => 0.25,
        'quality' => 0.25,
        'users' => 0.15,
    ],

    'liquidity_weights' => [
        'secondary' => 0.60,
        'spread' => 0.30,
        'time' => 0.10,
    ],

];
