<?php

return [

    'goldapi' => [
        'key' => env('GOLD_API_KEY'),
        // Live API calls per day. Free plan = 100 requests/month, so 3/day (~93/month) is safe.
        'calls_per_day' => env('GOLD_API_CALLS_PER_DAY', 3),
        // Hard monthly cap on API calls; set to 0 to disable (e.g. on a paid plan).
        // Flat rupees per gram added on top of the live rate shown on the website (0 = show the live rate as is).
        'markup' => env('GOLD_PRICE_MARKUP', 0),
        'monthly_limit' => env('GOLD_API_MONTHLY_LIMIT', 100),
    ],

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

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

];
