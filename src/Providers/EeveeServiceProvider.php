<?php

namespace Eevee\Providers;

use Illuminate\Support\ServiceProvider;

class EeveeServiceProvider extends ServiceProvider
{
    /**
     * Boot
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->registerPublishing();
        }
    }

    /**
     * Register
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('eevee');
    }

    /**
     * Register publishing
     */
    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../../config/eevee.php' => config_path('eevee.php')
        ], 'eevee-config');
    }
}