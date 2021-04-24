<?php

namespace Obydul\LyptoAPI\Libraries\Binance;

use Obydul\LyptoAPI\Clients\BinanceClient;
use Obydul\LyptoAPI\Libraries\LyptoRequest;

trait BinanceCommon
{
    use BinanceClient;

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
     * current price of a pair.
     */
    public function currentPrice(LyptoRequest $request)
    {
        // send request
        $response = $this->client->get("api/v3/ticker/price", $request->all());
        return $response->json();
    }
}