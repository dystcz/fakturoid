<?php

namespace Dystcz\LaravelFakturoid;

use Dystcz\LaravelFakturoid\Facades\Fakturoid as FakturoidFacade;
use Illuminate\Support\ServiceProvider;

class FakturoidServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/fakturoid.php' => config_path('fakturoid.php'),
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
        $this->mergeConfigFrom(__DIR__.'/../config/fakturoid.php', 'fakturoid');

        $this->app->singleton('laravel-fakturoid', function () {
            return new FakturoidFacade;
        });
    }
}
