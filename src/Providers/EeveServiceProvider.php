<?php

namespace Eeve\Providers;

use Illuminate\Support\ServiceProvider;

class EeveServiceProvider extends ServiceProvider
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
        return array('eeve');
    }

    /**
     * Register publishing
     */
    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../../config/eeve.php' => config_path('eeve.php')
        ], 'eeve-config');
    }
}