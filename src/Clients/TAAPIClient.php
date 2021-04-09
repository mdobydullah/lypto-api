<?php

namespace Obydul\LyptoAPI\Clients;

use Illuminate\Support\Facades\Http;

trait  TAAPIClient
{
    public static $client;

    /**
     * constructor.
     */
    public function __construct()
    {
        // check config
        if (empty(config('lyptoapi.taapi_secret'))) {
            die("Please set TAAPI secret in .env file");
        }

        // api base uri
        $base_uri = "https://api.taapi.io/";

        // client
        self::$client = Http::withOptions(['base_uri' => $base_uri])
            ->withHeaders([
                'Content-Type' => "application/json",
            ]);
    }
}
