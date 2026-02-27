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

];
