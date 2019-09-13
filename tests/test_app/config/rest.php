<?php

use Cake\Cache\Engine\FileEngine;

return [
    'Rest' => [
        'jwt' => [
            'key' => 'C4U6t!S3r2U@@h@*9h3%R#D2%Kn4&lt#M$d',
            'algorithm' => 'HS256'
        ]
    ],

    /**
     * Configure the cache for routes. The cached routes collection is built the
     * first time the routes are processed via `config/routes.php`.
     * Duration will be set to '+2 seconds' in bootstrap.php when debug = true
     */
    '_cake_routes_' => [
        'className' => FileEngine::class,
        'prefix' => 'myapp_cake_routes_',
        'path' => CACHE,
        'serialize' => true,
        'duration' => '+1 years',
        'url' => env('CACHE_CAKEROUTES_URL', null),
    ],
];
