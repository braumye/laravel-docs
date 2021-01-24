<?php

namespace Braumye\LaravelDocs;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LaravelDocsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerRoutes();
        $this->registerResources();
        $this->defineAssetPublishing();
    }

    protected function registerRoutes()
    {
        Route::group([
            'domain' => config('docs.domain', null),
            'prefix' => config('docs.path'),
            'middleware' => config('docs.middleware', 'web'),
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'docs');
    }

    protected function defineAssetPublishing()
    {
        $this->publishes([
            realpath(__DIR__.'/../public') => public_path('vendor/docs'),
        ], 'docs-assets');
    }

    public function register()
    {
        $this->offerPublishing();
        $this->registerCommands();
    }

    protected function offerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/docs.php' => config_path('docs.php'),
            ], 'docs-config');
        }
    }

    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\InstallCommand::class,
                Console\PublishCommand::class,
            ]);
        }
    }
}
