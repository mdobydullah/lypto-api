<?php

namespace Obydul\LyptoAPI\Libraries\KuCoin;

use Obydul\LyptoAPI\Clients\KuCoinClient;
use Obydul\LyptoAPI\Libraries\LyptoRequest;

trait KuCoinTicker
{
    use KuCoinClient;

    /**
     * current price of a pair.
     */
    public function currentPrice(LyptoRequest $request)
    {
        $endpoint = "/api/v1/market/orderbook/level1?" . $request->query();
        $method = "GET";
        $client = $this->client->withHeaders([
            'KC-API-SIGN' => $this->signature($method, $endpoint),
        ]);

        // send request
        $response = $client->get($endpoint);
        return $response->json();
    }

    /**
     * 24 hours price change of a pair.
     */
    public function priceChange24Hr(LyptoRequest $request)
    {
        $endpoint = "/api/v1/market/stats?" . $request->query();
        $method = "GET";
        $client = $this->client->withHeaders([
            'KC-API-SIGN' => $this->signature($method, $endpoint),
        ]);

        // send request
        $response = $client->get($endpoint);
        return $response->json();
    }
}
