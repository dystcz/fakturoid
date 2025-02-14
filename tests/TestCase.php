<?php

namespace Dystcz\Fakturoid\Tests;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    use WithWorkbench;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @param  Application  $app
     */
    protected function getPackageProviders($app): array
    {
        return [
            \Dystcz\Fakturoid\FakturoidServiceProvider::class,
        ];
    }

    /**
     * @param  Application  $app
     */
    protected function defineEnvironment($app): void
    {
        $app->useEnvironmentPath(__DIR__.'/../..');
        $app->bootstrapWith([LoadEnvironmentVariables::class]);

        tap($app['config'], function (Repository $config) {
            $config->set('database.default', 'sqlite');
            $config->set('database.migrations', 'migrations');
            $config->set('database.connections.sqlite', [
                'driver' => 'sqlite',
                'database' => ':memory:',
                'prefix' => '',
            ]);
        });
    }

    /**
     * Define database migrations.
     */
    protected function defineDatabaseMigrations(): void
    {
        $this->loadLaravelMigrations();
        // $this->loadMigrationsFrom(workbench_path('database/migrations'));
    }
}
