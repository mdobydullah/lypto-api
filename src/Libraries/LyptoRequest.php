<?php

namespace Obydul\LyptoAPI\Libraries;

class LyptoRequest
{
    private $vars;

    /**
     * set.
     */
    public function __set($name, $value)
    {
        $this->vars[$name] = $value;
    }

    /**
     * get.
     */
    public function __get($name)
    {
        return $this->vars[$name];
    }

    /**
     * show requests as array.
     */
    public function all()
    {
        return $this->vars;
    }

    /**
     * convert array to query string.
     */
    public function query()
    {
        return http_build_query($this->vars);
    }

    /**
     * add required parameters of TAAPI.
     */
    public function taapi()
    {
        // important parameter
        $params = [
            'secret' => config('lyptoapi.taapi_secret')
        ];
        $requests = $params + $this->vars;

        return $requests;
    }
}
