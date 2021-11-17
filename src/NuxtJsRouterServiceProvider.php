<?php

namespace Maarsson\NuxtJsRouter;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class NuxtJsRouterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerRoutes();
        $this->registerPublishing();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->configure();
    }

    /**
     * Setup the configuration.
     *
     * @return void
     */
    protected function configure()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/nuxtjs.php',
            'nuxtjs'
        );
    }

    /**
     * Register the NuxtJs routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::group([
            'middleware' => 'nuxt',
            'namespace' => '\Maarsson\NuxtJsRouter\Http\Controllers',
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/nuxtjs.php');
        });
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
                __DIR__ . '/../config/nuxtjs.php' => $this->app->configPath('nuxtjs.php'),
            ], 'nuxtjs-config');
        }
    }
}
