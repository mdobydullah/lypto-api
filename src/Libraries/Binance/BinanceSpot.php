<?php

namespace Obydul\LyptoAPI\Libraries\Binance;

use Obydul\LyptoAPI\Clients\BinanceClient;
use Obydul\LyptoAPI\Libraries\LyptoRequest;

trait BinanceSpot
{
    use BinanceClient;

    /**
     * create order.
     */
    public function createOrder(LyptoRequest $request)
    {
        // add additional parameters
        $request->timestamp = $this->timestamp;
        $request->signature = $this->signature($request->query());

        // send request
        $response = $this->client->asForm()->post("api/v3/order", $request->all());
        return $response->json();
    }

    /**
     * cancel order.
     */
    public function cancelOrder(LyptoRequest $request)
    {
        // add additional parameters
        $request->timestamp = $this->timestamp;
        $request->signature = $this->signature($request->query());

        // send request
        $response = $this->client->delete("api/v3/order", $request->all());
        return $response->json();
    }

    /**
     * cancel open orders.
     */
    public function cancelOpenOrders(LyptoRequest $request)
    {
        // add additional parameters
        $request->timestamp = $this->timestamp;
        $request->signature = $this->signature($request->query());

        // send request
        $response = $this->client->delete("api/v3/openOrders", $request->all());
        return $response->json();
    }

    /**
     * query order.
     */
    public function queryOrder(LyptoRequest $request)
    {
        // add additional parameters
        $request->timestamp = $this->timestamp;
        $request->signature = $this->signature($request->query());

        // send request
        $response = $this->client->get("api/v3/order", $request->all());
        return $response->json();
    }

    /**
     * current open orders.
     */
    public function currentOpenOrders(LyptoRequest $request)
    {
        // add additional parameters
        $request->timestamp = $this->timestamp;
        $request->signature = $this->signature($request->query());

        // send request
        $response = $this->client->get("api/v3/openOrders", $request->all());
        return $response->json();
    }

    /**
     * all orders.
     */
    public function allOrders(LyptoRequest $request)
    {
        // add additional parameters
        $request->timestamp = $this->timestamp;
        $request->signature = $this->signature($request->query());

        // send request
        $response = $this->client->get("api/v3/allOrders", $request->all());
        return $response->json();
    }

    /**
     * create OCO.
     */
    public function createOCO(LyptoRequest $request)
    {
        // add additional parameters
        $request->timestamp = $this->timestamp;
        $request->signature = $this->signature($request->query());

        // send request
        $response = $this->client->asForm()->post("api/v3/order/oco", $request->all());
        return $response->json();
    }

    /**
     * cancel OCO.
     */
    public function cancelOCO(LyptoRequest $request)
    {
        // add additional parameters
        $request->timestamp = $this->timestamp;
        $request->signature = $this->signature($request->query());

        // send request
        $response = $this->client->delete("api/v3/orderList", $request->all());
        return $response->json();
    }

    /**
     * query OCO.
     */
    public function queryOCO(LyptoRequest $request)
    {
        // add additional parameters
        $request->timestamp = $this->timestamp;
        $request->signature = $this->signature($request->query());

        // send request
        $response = $this->client->get("api/v3/orderList", $request->all());
        return $response->json();
    }

    /**
     * query all OCO.
     */
    public function queryAllOCO(LyptoRequest $request)
    {
        // add additional parameters
        $request->timestamp = $this->timestamp;
        $request->signature = $this->signature($request->query());

        // send request
        $response = $this->client->get("api/v3/allOrderList", $request->all());
        return $response->json();
    }

    /**
     * query open OCO.
     */
    public function queryOpenOCO(LyptoRequest $request)
    {
        // add additional parameters
        $request->timestamp = $this->timestamp;
        $request->signature = $this->signature($request->query());

        // send request
        $response = $this->client->get("api/v3/openOrderList", $request->all());
        return $response->json();
    }

    /**
     *account trade list.
     */
    public function accountTradeList(LyptoRequest $request)
    {
        // add additional parameters
        $request->timestamp = $this->timestamp;
        $request->signature = $this->signature($request->query());

        // send request
        $response = $this->client->get("api/v3/myTrades", $request->all());
        return $response->json();
    }
}
