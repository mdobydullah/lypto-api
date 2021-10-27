<?php

return [
    // mode
    'mode' => env('LYPTO_API_MODE', 'sandbox'), // sandbox or live
    // exchanges
    'binance_api_key' => env('LYPTO_API_BINANCE_KEY', ''),
    'binance_api_secret' => env('LYPTO_API_BINANCE_SECRET', ''),
    'kucoin_api_key' => env('LYPTO_API_KUCOIN_KEY', ''),
    'kucoin_api_secret' => env('LYPTO_API_KUCOIN_SECRET', ''),
    'kucoin_api_passphrase' => env('LYPTO_API_KUCOIN_PASSPHRASE', ''),
    // tools
    'taapi_secret' => env('LYPTO_API_TAAPI_SECRET', ''),
];
