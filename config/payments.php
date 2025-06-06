<?php

return [
  'mpesa' => [
      'env' => env('MPESA_ENV'),
      'consumer_key' => env('MPESA_CONSUMER_KEY'),
      'consumer_secret' => env('MPESA_CONSUMER_SECRET'),
      'shortcode' => env('MPESA_SHORTCODE'),
      'passkey' => env('MPESA_PASSKEY'),
      'callback_url' => env('MPESA_CALLBACK_URL'),
  ],

    'crypto' => [
        'env' => env('CRYPTO_ENV'),
        'ipn_key' => env('CRYPTO_IPN_KEY'),
        'api_key' => env('CRYPTO_API_KEY'),
    ]
];
