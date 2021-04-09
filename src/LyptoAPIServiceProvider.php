<?php

namespace Obydul\LyptoAPI;

use Illuminate\Support\ServiceProvider;
use Obydul\LyptoAPI\Exchanges\Binance;
use Obydul\LyptoAPI\Tools\TAAPI;

class LyptoAPIServiceProvider extends ServiceProvider
{
    /**
     * bootstrap application services.
     *
     * @return void
     */
    public function boot()
    {
        // publish config file
        $this->publishes([
            __DIR__ . './../config/config.php' => config_path('lyptoapi.php'),
        ], 'config');

        // binance facade
        $this->app->bind('binance', function ($app) {
            return new Binance();
        });

        // taapi facade
        $this->app->bind('taapi', function ($app) {
            return new TAAPI();
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'lyptoapi');
    }
}
