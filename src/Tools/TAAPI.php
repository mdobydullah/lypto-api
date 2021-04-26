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
        // add api key
        $params = [
            'secret' => $this->api_key
        ];
        $requests = $params + $request->all();

        // send request
        $response = $this->client->get($endpoint, $requests);
        return $response->json();
    }
}
