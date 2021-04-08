<?php

namespace Obydul\LyptoAPI\Clients;

use Illuminate\Support\Facades\Http;

trait  BinanceClient
{
    public $isLive, $client, $timestamp, $signature;

    /**
     * constructor.
     */
    public function __construct()
    {
        // check config
        if (empty(config('lyptoapi.mode')) || empty(config('lyptoapi.binance_api_key')) || empty(config('lyptoapi.binance_api_secret'))) {
            die("Please set api mode, api key and secret in .env file");
        }

        // check mode
        if (config('lyptoapi.mode') == "live")
            $this->isLive = true;
        else
            $this->isLive = false;

        // api base uri
        $base_uri = $this->isLive ? "https://api.binance.com/" : "https://testnet.binance.vision/";

        // client
        $this->client = Http::withOptions(['base_uri' => $base_uri])
            ->withHeaders([
                'Content-Type' => "application/json",
                'X-MBX-APIKEY' => config('lyptoapi.binance_api_key'),
            ]);

        // generate timestamp
        $this->timestamp = now()->timestamp * 1000;
    }

    /**
     * generate signature.
     */
    public function signature($query_string)
    {
        return hash_hmac('sha256', $query_string, config('lyptoapi.binance_api_secret'));
    }
}
