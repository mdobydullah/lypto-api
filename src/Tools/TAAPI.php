<?php

namespace Obydul\LyptoAPI\Tools;

use Obydul\LyptoAPI\Clients\TAAPIClient;
use Obydul\LyptoAPI\Libraries\LyptoRequest;

class TAAPI
{
    use TAAPIClient;

    /**
     * get indicator value.
     */
    public function get($endpoint, LyptoRequest $request)
    {
        // send request
        $response = $this->client->get($endpoint, $request->taapi());
        return $response->json();
    }
}
