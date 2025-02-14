<?php

namespace Dystcz\Fakturoid;

use Dystcz\Fakturoid\Contracts\Fakturoid as FakturoidContract;
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

        $this->app->singleton(FakturoidContract::class, fn () => new Fakturoid);
    }
}
