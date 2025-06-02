<?php

namespace AiSeo\LaravelAiSeo;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class AiSeoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/aiseo.php', 'aiseo'
        );

        $this->app->singleton('aiseo', function (Application $app) {
            return new AiSeoService($app['config']);
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/aiseo.php' => config_path('aiseo.php'),
            ], 'aiseo-config');
        }
    }
} 