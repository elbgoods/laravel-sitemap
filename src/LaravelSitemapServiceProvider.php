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
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('sitemap.php'),
            ], 'config');

            // Registering package commands.
            $this->commands([
                GenerateCommand::class,
            ]);
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
