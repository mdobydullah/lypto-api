<?php

namespace Obydul\LyptoAPI\Libraries\KuCoin;

use Obydul\LyptoAPI\Clients\KuCoinClient;
use Obydul\LyptoAPI\Libraries\LyptoRequest;

trait KuCoinCommon
{
    use KuCoinClient;

    /**
     * server time.
     */
    public function time()
    {
        // send request
        $response = $this->client->get("api/v1/timestamp");
        return $response->json();
    }

    /**
     * server status.
     */
    public function status()
    {
        // send request
        $response = $this->client->get("api/v1/status");
        return $response->json();
    }

    /**
     * account info.
     */
    public function accountInfo()
    {
        $endpoint = "/api/v1/accounts";
        $method = "GET";
        $client = $this->client->withHeaders([
            'KC-API-SIGN' => $this->signature($method, $endpoint),
        ]);

        // send request
        $response = $client->get($endpoint);
        return $response->json();
    }

    /**
     * sub users.
     */
    public function subUsers()
    {
        $endpoint = "/api/v1/sub/user";
        $method = "GET";
        $client = $this->client->withHeaders([
            'KC-API-SIGN' => $this->signature($method, $endpoint),
        ]);

        // send request
        $response = $client->get($endpoint);
        return $response->json();
    }
}
