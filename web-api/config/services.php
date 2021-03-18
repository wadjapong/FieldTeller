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

    'cbs' => [
        'endpoint' => env('CBS_BASEURL'),
        'username' => env('CBS_USERNAME'),
        'password' => env('CBS_PASSWORD'),
    ],

    'hubtel' => [
        'endpoint' => env('HUBTEL_SMS_API_BASEURL'),
        'sender_id' => env('HUBTEL_SMS_SENDER_ID'),
        'client_id' => env('HUBTEL_SMS_CLIENT_ID'),
        'client_secret' => env('HUBTEL_SMS_CLIENT_SECRET'),
    ],

    'smsonlinegh' => [
        'endpoint' => env('SMSONLINEGH_API_BASEURL'),
        'sender_id' => env('SMSONLINEGH_API_SENDER_ID'),
        'client_id' => env(''),
        'client_secret' => env(''),
    ],

];
