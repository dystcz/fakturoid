<?php

namespace Dystcz\LaravelFakturoid;

use Illuminate\Support\ServiceProvider;
use Dystcz\LaravelFakturoid\LaravelFakturoid;

class FakturoidServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/fakturoid.php' => config_path('fakturoid.php'),
            ], 'config');
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/fakturoid.php', 'fakturoid');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-fakturoid', function () {
            return new LaravelFakturoid;
        });
    }
}
