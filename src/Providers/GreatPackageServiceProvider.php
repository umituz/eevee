<?php

namespace GreatPackage\Providers;

use Illuminate\Support\ServiceProvider;

class GreatPackageServiceProvider extends ServiceProvider
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
        return array('great-package');
    }

    /**
     * Register publishing
     */
    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../../config/great-package.php' => config_path('great-package.php')
        ], 'great-package-config');
    }
}