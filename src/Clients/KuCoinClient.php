<?php

namespace Obydul\LyptoAPI\Clients;

use Illuminate\Support\Facades\Http;

trait  KuCoinClient
{
    private $kucoin_api_key, $kucoin_api_secret, $kucoin_api_passphrase, $mode;
    private $isLive, $client, $timestamp;

    /**
     * constructor.
     */
    public function __construct($api_key = null, $api_secret = null, $passphrase = null, $mode = "live")
    {
        $this->checkConfig($api_key, $api_secret, $passphrase, $mode);
        return $this;
    }

    /**
     * config function - specially for facade
     */
    public function config($api_key = null, $api_secret = null, $passphrase = null, $mode = "live")
    {
        $this->checkConfig($api_key, $api_secret, $passphrase, $mode);
        return $this;
    }

    /**
     * config function - specially for facade
     */
    public function checkConfig($api_key = null, $api_secret = null, $passphrase = null, $mode = "live")
    {
        // check config
        if ($api_secret == null || $api_secret == null || $passphrase == null) {
            if (empty(config('lyptoapi.mode')) || empty(config('lyptoapi.kucoin_api_key')) || empty(config('lyptoapi.kucoin_api_secret')) || empty(config('lyptoapi.kucoin_api_passphrase'))) {
                die("Please set api mode, api key, passphrase and secret in .env file");
            }
        }

        // generate timestamp
        $this->timestamp = now()->timestamp * 1000;

        // set config from controller and .env
        if ($api_key != null && $api_secret != null) {
            $this->mode = $mode;
            $this->kucoin_api_key = $api_key;
            $this->kucoin_api_secret = $api_secret;
            $this->kucoin_api_passphrase = $passphrase;
        } else {
            $this->mode = config('lyptoapi.mode');
            $this->kucoin_api_key = config('lyptoapi.kucoin_api_key');
            $this->kucoin_api_secret = config('lyptoapi.kucoin_api_secret');
            $this->kucoin_api_passphrase = config('lyptoapi.kucoin_api_passphrase');
        }

        // check mode
        if ($this->mode == "live")
            $this->isLive = true;
        else
            $this->isLive = false;

        // api base uri
        $base_uri = $this->isLive ? "https://api.kucoin.com" : "https://openapi-sandbox.kucoin.com";

        // client
        $this->client = Http::withOptions(['base_uri' => $base_uri])
            ->withHeaders([
                'Content-Type' => "application/json",
                'KC-API-TIMESTAMP' => $this->timestamp,
                'KC-API-KEY' => $this->kucoin_api_key,
                'KC-API-PASSPHRASE' => base64_encode(hash_hmac("sha256", $this->kucoin_api_passphrase, $this->kucoin_api_secret, true)),
                'KC-API-KEY-VERSION' => 2,
            ]);
    }

    /**
     * generate signature.
     */
    public function signature($method = 'GET', $endpoint = '', $body = '')
    {
        $body = is_array($body) ? json_encode($body) : $body; // Body must be in json format

        $timestamp = now()->timestamp * 1000;

        $what = $timestamp . $method . $endpoint . $body;

        return base64_encode(hash_hmac("sha256", $what, $this->kucoin_api_secret, true));
    }
}
