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

    /*系统服务开关配置*/
    'geetest_open' => env('GEETEST_OPEN',false), //极验证开关
    'oauth_open'   => env('OAUTH_OPEN',0),       //oauth登陆开关
    'sms_open'     => env('SMS_OPEN',0),

    /*oauth 登陆项目配置*/
    'qq' => [
        'open' => env('OAUTH_QQ_OPEN',0),
        'client_id' => env('OAUTH_QQ_KEY'),
        'client_secret' => env('OAUTH_QQ_SECRET'),
        'redirect' => env('OAUTH_QQ_REDIRECT'),
    ],
    'weibo' => [
        'open' => env('OAUTH_WEIBO_OPEN',0),
        'client_id' => env('OAUTH_WEIBO_KEY'),
        'client_secret' => env('OAUTH_WEIBO_SECRET'),
        'redirect' => env('OAUTH_WEIBO_REDIRECT'),
    ],
    'weixin' => [
        'open' => env('OAUTH_WEIXIN_OPEN',0),
        'client_id' => env('OAUTH_WEIXIN_KEY'),
        'client_secret' => env('OAUTH_WEIXIN_SECRET'),
        'redirect' => env('OAUTH_WEIXIN_REDIRECT'),
    ],
    'weixinweb' => [
        'open' => env('OAUTH_WEIXINWEB_OPEN',0),
        'client_id' => env('OAUTH_WEIXINWEB_KEY'),
        'client_secret' => env('OAUTH_WEIXINWEB_SECRET'),
        'redirect' => env('OAUTH_WEIXINWEB_REDIRECT'),
    ],
    'weapp' => [
        'open' => env('WEAPP_OPEN',0),
        'app_id' => env('WEAPP_APP_ID'),
        'app_secret' => env('WEAPP_APP_SECRET')
    ]

];
