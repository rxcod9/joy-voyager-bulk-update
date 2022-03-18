<?php

return [

    /*
     * If enabled for voyager-bulk-update package.
     */
    'enabled' => env('VOYAGER_BULK_UPDATE_ENABLED', true),

    /*
    | Here you can specify for which data type slugs bulk-update is enabled
    | 
    | Supported: "*", or data type slugs "users", "roles"
    |
    */

    'allowed_slugs' => array_filter(explode(',', env('VOYAGER_BULK_UPDATE_ALLOWED_SLUGS', '*'))),

    /*
    | Here you can specify for which data type slugs bulk-update is not allowed
    | 
    | Supported: "*", or data type slugs "users", "roles"
    |
    */

    'not_allowed_slugs' => array_filter(explode(',', env('VOYAGER_BULK_UPDATE_NOT_ALLOWED_SLUGS', ''))),

    /*
     * The config_key for voyager-bulk-update package.
     */
    'config_key' => env('VOYAGER_BULK_UPDATE_CONFIG_KEY', 'joy-voyager-bulk-update'),

    /*
     * The route_prefix for voyager-bulk-update package.
     */
    'route_prefix' => env('VOYAGER_BULK_UPDATE_ROUTE_PREFIX', 'joy-voyager-bulk-update'),

    /*
    |--------------------------------------------------------------------------
    | Controllers config
    |--------------------------------------------------------------------------
    |
    | Here you can specify voyager controller settings
    |
    */

    'controllers' => [
        'namespace' => 'Joy\\VoyagerBulkUpdate\\Http\\Controllers',
    ],
];
