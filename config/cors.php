<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'allow_methods' => ['*'],
    'allowed_origins' => ['https://rompypumpy.com'],
    'allow_headers' => ['*'],

    'expose_headers' => [],

    'forbidden_response' => [
        'message' => 'Forbidden (cors).',
        'status' => 403,
    ],
    'max_age' => 0,

    'supports_credentials' => false,

];
