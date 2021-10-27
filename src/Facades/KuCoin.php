<?php

namespace Obydul\LyptoAPI\Facades;

use Illuminate\Support\Facades\Facade;

class KuCoin extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'kucoin';
    }
}
