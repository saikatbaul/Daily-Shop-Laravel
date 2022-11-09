<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    // 'facebook' => [
    //     'client_id'     => '516537189462699',
    //     'client_secret' => 'd56dde4fe1e439f59274c6d912619bf9',
    //     'redirect'      => 'http://localhost:8000/login_with_facebook/callback',
    // ],

    // 'google' => [
    //     'client_id'     => '199493034609-kn0uplfhr666lcm146a37r7d230j9q1e.apps.googleusercontent.com',
    //     'client_secret' => 'MnPvdbVhv5oX35AeBGFjnLoS',
    //     'redirect'      => 'http://localhost:8000/login_with_google/callback',
    // ],

    'facebook' => [
        'client_id'     => '516537189462699',
        'client_secret' => 'd56dde4fe1e439f59274c6d912619bf9',
        'redirect'      => 'https://dailyshop.thevoice24.com/login_with_facebook/callback',
    ],

    'google' => [
        'client_id'     => '199493034609-kn0uplfhr666lcm146a37r7d230j9q1e.apps.googleusercontent.com',
        'client_secret' => 'MnPvdbVhv5oX35AeBGFjnLoS',
        'redirect'      => 'https://dailyshop.thevoice24.com/login_with_google/callback',
    ],

];
