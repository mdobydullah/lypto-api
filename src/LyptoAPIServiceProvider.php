<?php

namespace Obydul\LyptoAPI;

use Illuminate\Support\ServiceProvider;
use Obydul\LyptoAPI\Exchanges\Binance;

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
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'lyptoapi');
    }
}
