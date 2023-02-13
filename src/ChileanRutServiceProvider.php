<?php

namespace Devlabs\ChileanRut;

use Illuminate\Support\ServiceProvider;

class ChileanRutServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/chileanrut.php', 'chileanrut');

        // Register the service the package provides.
        $this->app->singleton('chileanrut', function ($app) {
            return new ChileanRut;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['chileanrut'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/chileanrut.php' => config_path('chileanrut.php'),
        ], 'chileanrut.config');
    }
}
