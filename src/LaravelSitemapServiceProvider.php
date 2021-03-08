<?php

namespace Elbgoods\LaravelSitemap;

use Elbgoods\LaravelSitemap\Commands\Sitemap\GenerateCommand;
use Illuminate\Support\ServiceProvider;

class LaravelSitemapServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-sitemap');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-sitemap');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-sitemap.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-sitemap'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-sitemap'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-sitemap'),
            ], 'lang');*/

            // Registering package commands.
            if ($this->app->runningInConsole()) {
                $this->commands([
                    GenerateCommand::class,
                ]);
            }
        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-sitemap');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-sitemap', function () {
            return new LaravelSitemap();
        });
    }
}
