<?php

namespace Obydul\LyptoAPI\Clients;

use Illuminate\Support\Facades\Http;

trait  TAAPIClient
{
    public $api_key, $client;

    /**
     * constructor.
     */
    public function __construct($api_key = null)
    {
        $this->checkConfig($api_key);
        return $this;
    }

    /**
     * config function - specially for facade
     */
    public function config($api_key = null)
    {
        $this->checkConfig($api_key);
        return $this;
    }

    /**
     * config function - specially for facade
     */
    public function checkConfig($api_key = null)
    {
        // check config
        if ($api_key == null) {
            if (empty(config('lyptoapi.taapi_secret'))) {
                die("Please pass TAAPI api key");
            }
        }

        // set config from controller and .env
        if ($api_key != null) {
            $this->api_key = $api_key;
        } else {
            $this->api_key = config('lyptoapi.taapi_secret');
        }

        // api base uri
        $base_uri = "https://api.taapi.io/";

        // client
        $this->client = Http::timeout(5)->withOptions(['base_uri' => $base_uri])
            ->withHeaders([
                'Content-Type' => "application/json",
            ]);
    }
}
