<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\Models\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'qq' => [
        'client_id' => env('OAUTH_QQ_KEY'),
        'client_secret' => env('OAUTH_QQ_SECRET'),
        'redirect' => env('OAUTH_QQ_REDIRECT'),
    ],
    'weibo' => [
        'client_id' => env('OAUTH_WEIBO_KEY'),
        'client_secret' => env('OAUTH_WEIBO_SECRET'),
        'redirect' => env('OAUTH_WEIBO_REDIRECT'),
    ],

];
