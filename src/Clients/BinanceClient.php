<?php

namespace Obydul\LyptoAPI\Clients;

use Illuminate\Support\Facades\Http;

trait  BinanceClient
{
    private $binance_api_key, $binance_api_secret, $mode;
    private $isLive, $client, $timestamp;

    /**
     * constructor.
     */
    public function __construct($api_key = null, $api_secret = null, $mode = "live")
    {
        $this->checkConfig($api_key, $api_secret, $mode);
        return $this;
    }

    /**
     * config function - specially for facade
     */
    public function config($api_key = null, $api_secret = null, $mode = "live")
    {
        $this->checkConfig($api_key, $api_secret, $mode);
        return $this;
    }

    /**
     * config function - specially for facade
     */
    public function checkConfig($api_key = null, $api_secret = null, $mode = "live")
    {
        // check config
        if ($api_secret == null || $api_secret == null) {
            if (empty(config('lyptoapi.mode')) || empty(config('lyptoapi.binance_api_key')) || empty(config('lyptoapi.binance_api_secret'))) {
                die("Please set api mode, api key and secret in .env file");
            }
        }

        // set config from controller and .env
        if ($api_key != null && $api_secret != null) {
            $this->mode = $mode;
            $this->binance_api_key = $api_key;
            $this->binance_api_secret = $api_secret;
        } else {
            $this->mode = "sanxbox";
            $this->binance_api_key = config('lyptoapi.binance_api_key');
            $this->binance_api_secret = config('lyptoapi.binance_api_secret');
        }

        // check mode
        if (config('lyptoapi.mode') == "live" || $this->mode == "live")
            $this->isLive = true;
        else
            $this->isLive = false;

        // api base uri
        $base_uri = $this->isLive ? "https://api.binance.com/" : "https://testnet.binance.vision/";

        // client
        $this->client = Http::timeout(5)->withOptions(['base_uri' => $base_uri])
            ->withHeaders([
                'Content-Type' => "application/json",
                'X-MBX-APIKEY' => $this->binance_api_key,
            ]);

        // generate timestamp
        $this->timestamp = now()->timestamp * 1000;
    }

    /**
     * generate signature.
     */
    public function signature($query_string)
    {
        return hash_hmac('sha256', $query_string, $this->binance_api_secret);
    }
}
