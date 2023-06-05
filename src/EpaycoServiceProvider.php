<?php

namespace LaravelLatam\Epayco;

use LaravelLatam\Epayco\View\Components\Layout;
use LaravelLatam\Epayco\View\Components\MenuUser;
use LaravelLatam\Epayco\Commands\EpaycoCommand;
use LaravelLatam\Epayco\Http\Middleware\VerifyRedirectUrl;

use Illuminate\Support\Facades\Route;   
use Illuminate\Support\ServiceProvider;

class EpaycoServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerRoutes();
        $this->registerResources();
        $this->registerMigrations();
        $this->registerPublishing();

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/epayco.php' => config_path('epayco.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/epayco'),
            ], 'views');

            $migrationFileName = 'create_epayco_table.php';
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                ], 'migrations');
            }

            $this->commands([
                EpaycoCommand::class,
            ]);
        }

    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/epayco.php', 'epayco');
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        if (Epayco::$registersRoutes) {
            Route::group([
                'middleware' => ['web',VerifyRedirectUrl::class,'auth:sanctum', 'verified'],
                'prefix' => config('epayco.path'),
                'namespace' => 'LaravelLatam\Epayco\Http\Controllers',
                'as' => 'epayco.',
            ], function () {
                $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
            });
        }
    }

    /**
     * Register the package resources.
     *
     * @return void
     */
    protected function registerResources()
    {
        $this->loadJsonTranslationsFrom(__DIR__.'/../resources/lang');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'epayco');
        $this->loadViewComponentsAs('epayco', [
            Layout::class,
            MenuUser::class,
        ]);
    }

    /**
     * Register the package migrations.
     *
     * @return void
     */
    protected function registerMigrations()
    {
        if (Epayco::$runsMigrations && $this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/epayco.php' => $this->app->configPath('epayco.php'),
            ], 'epayco-config');

            $this->publishes([
                __DIR__.'/../database/migrations' => $this->app->databasePath('migrations'),
            ], 'epayco-migrations');

            $this->publishes([
                __DIR__.'/../resources/views' => $this->app->resourcePath('views/vendor/epayco'),
            ], 'epayco-views');
        }
    }
    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }
}
