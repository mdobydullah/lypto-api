<?php

namespace Obydul\LyptoAPI\Facades;

use Illuminate\Support\Facades\Facade;

class TAAPIFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'taapi';
    }
}
