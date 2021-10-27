<?php

namespace Obydul\LyptoAPI\Libraries\KuCoin;

use Obydul\LyptoAPI\Clients\KuCoinClient;
use Obydul\LyptoAPI\Libraries\LyptoRequest;

trait KuCoinSpot
{
    use KuCoinClient;

    /**
     * create order.
     */
    public function createOrder(LyptoRequest $request)
    {
        $endpoint = "/api/v1/orders";
        $method = "POST";
        $client = $this->client->withHeaders([
            'KC-API-SIGN' => $this->signature($method, $endpoint, $request->json()),
        ]);

        // send request
        $response = $client->post($endpoint, $request->array()); // ->asJson()
        return $response->json();
    }

    /**
     * all orders.
     */
    public function allOrders()
    {
        $endpoint = "/api/v1/orders";
        $method = "GET";
        $client = $this->client->withHeaders([
            'KC-API-SIGN' => $this->signature($method, $endpoint),
        ]);

        // send request
        $response = $client->get($endpoint);
        return $response->json();
    }

    /**
     * query order.
     */
    public function queryOrder($order_id)
    {
        $endpoint = "/api/v1/orders/" . $order_id;
        $method = "GET";
        $client = $this->client->withHeaders([
            'KC-API-SIGN' => $this->signature($method, $endpoint),
        ]);

        // send request
        $response = $client->get($endpoint);
        return $response->json();
    }

    /**
     * open orders.
     */
    public function openOrders(LyptoRequest $request)
    {
        $endpoint = "/api/v1/orders?" . $request->query();
        $method = "GET";
        $client = $this->client->withHeaders([
            'KC-API-SIGN' => $this->signature($method, $endpoint),
        ]);

        // send request
        $response = $client->get($endpoint);
        return $response->json();
    }

    /**
     * cancel order.
     */
    public function cancelOrder($order_id)
    {
        $endpoint = "/api/v1/orders/" . $order_id;
        $method = "DELETE";
        $client = $this->client->withHeaders([
            'KC-API-SIGN' => $this->signature($method, $endpoint),
        ]);

        // send request
        $response = $client->delete($endpoint);
        return $response->json();
    }

    /**
     * cancel open orders.
     */
    public function cancelOpenOrders(LyptoRequest $request)
    {
        $endpoint = "/api/v1/orders/" . $request->query();
        $method = "DELETE";
        $client = $this->client->withHeaders([
            'KC-API-SIGN' => $this->signature($method, $endpoint),
        ]);

        // send request
        $response = $client->delete($endpoint);
        return $response->json();
    }
}
