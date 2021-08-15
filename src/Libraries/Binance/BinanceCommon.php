<?php

namespace Obydul\LyptoAPI\Libraries\Binance;

use Obydul\LyptoAPI\Clients\BinanceClient;
use Obydul\LyptoAPI\Libraries\LyptoRequest;

trait BinanceCommon
{
    use BinanceClient;

    /**
     * ping server.
     */
    public function ping()
    {
        // send request
        $response = $this->client->get("api/v3/ping");
        return $response->json();
    }

    /**
     * server time.
     */
    public function time()
    {
        // send request
        $response = $this->client->get("api/v3/time");
        return $response->json();
    }

    /**
     * exchange info.
     */
    public function exchangeInfo()
    {
        // send request
        $response = $this->client->get("api/v3/exchangeInfo");
        return $response->json();
    }

    /**
     * account info.
     */
    public function accountInfo()
    {
        // request
        $request = new LyptoRequest();
        $request->timestamp = $this->timestamp;
        $request->signature = $this->signature($request->query());

        // send request
        $response = $this->client->get("api/v3/account", $request->all());
        return $response->json();
    }

    /**
     * account info.
     */
    public function accountStatus()
    {
        // request
        $request = new LyptoRequest();
        $request->timestamp = $this->timestamp;
        $request->signature = $this->signature($request->query());

        // send request
        $response = $this->client->get("/sapi/v1/account/status", $request->all());
        return $response->json();
    }

    /**
     * api trading status.
     */
    public function apiTradingStatus()
    {
        // add additional parameters
        $request = new LyptoRequest();
        $request->timestamp = $this->timestamp;
        $request->signature = $this->signature($request->query());

        // send request
        $response = $this->client->get("sapi/v1/account/apiTradingStatus", $request->all());
        return $response->json();
    }

    /**
     * account snapshot.
     */
    public function accountSnapshot(LyptoRequest $request)
    {
        // add additional parameters
        $request->timestamp = $this->timestamp;
        $request->signature = $this->signature($request->query());

        // send request
        $response = $this->client->get("sapi/v1/accountSnapshot", $request->all());
        return $response->json();
    }

    /**
     * current price of a pair.
     */
    public function currentPrice(LyptoRequest $request)
    {
        // send request
        $response = $this->client->get("api/v3/ticker/price", $request->all());
        return $response->json();
    }

    /**
     * 24 hours price change of a pair.
     */
    public function priceChange24Hr(LyptoRequest $request)
    {
        // send request
        $response = $this->client->get("api/v3/ticker/24hr", $request->all());
        return $response->json();
    }

    /**
     * average price of a pair (5 minutes).
     */
    public function avgPrice(LyptoRequest $request)
    {
        // send request
        $response = $this->client->get("api/v3/avgPrice", $request->all());
        return $response->json();
    }
}
