<?php

use Illuminate\Support\Env;

return [
    /*
    |--------------------------------------------------------------------------
    | Default Author
    |--------------------------------------------------------------------------
    |
    | The default author name to use when generating article schemas.
    |
    */
    'default_author' => Env::get('AISEO_DEFAULT_AUTHOR', 'AI Content Team'),

    /*
    |--------------------------------------------------------------------------
    | Publisher Name
    |--------------------------------------------------------------------------
    |
    | The name of your organization that publishes the content.
    |
    */
    'publisher_name' => Env::get('AISEO_PUBLISHER_NAME', 'laravelgpt'),

    /*
    |--------------------------------------------------------------------------
    | Logo URL
    |--------------------------------------------------------------------------
    |
    | The URL to your organization's logo for the publisher schema.
    |
    */
    'logo_url' => Env::get('AISEO_LOGO_URL', 'https://example.com/logo.png'),
]; 