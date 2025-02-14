<?php

namespace Dystcz\Fakturoid;

use Dystcz\Fakturoid\Contracts\Fakturoid as FakturoidContract;
use Fakturoid\FakturoidManager;
use GuzzleHttp\Client as Guzzle;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Config;
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

        $this->app->bind('fakturoid', fn (Application $app) => $app->make(FakturoidManager::class, [
            'client' => new Guzzle,
            'clientId' => Config::get('fakturoid.client_id'),
            'clientSecret' => Config::get('fakturoid.client_secret'),
            'userAgent' => Config::get('fakturoid.user_agent'),
            'accountSlug' => Config::get('fakturoid.account_slug'),
        ]));

        $this->app->singleton(
            FakturoidContract::class,
            fn (Application $app) => $app->make(Fakturoid::class, [
                'fakturoid' => $app->make('fakturoid'),
            ]));
    }
}
