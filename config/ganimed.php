<?php

return [

    /*
    |--------------------------------------------------------------------------
    | ГАНИМЕД — основной узел и health-check
    |--------------------------------------------------------------------------
    */

    'main_node_health_url' => env('GANIMED_MAIN_NODE_HEALTH_URL', 'https://main-node.gnd-net.com/api/v1/health'),

    /** Время кеширования результата health (секунды). */
    'health_cache_ttl' => (int) env('GANIMED_HEALTH_CACHE_TTL', 60),

    'main_node_block_latest_url' => env('GANIMED_MAIN_NODE_BLOCK_LATEST_URL', 'https://main-node.gnd-net.com/api/v1/block/latest'),

    /** Время кеширования результата block/latest (секунды). */
    'block_cache_ttl' => (int) env('GANIMED_BLOCK_CACHE_TTL', 60),

];
