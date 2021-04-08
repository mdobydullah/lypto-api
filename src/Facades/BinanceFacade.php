<?php

namespace Obydul\LyptoAPI\Facades;

use Illuminate\Support\Facades\Facade;

class BinanceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'binance';
    }
}
