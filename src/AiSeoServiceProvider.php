<?php

namespace AiSeo\LaravelAiSeo;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AiSeoServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-aiseo')
            ->hasConfigFile()
            ->hasConfigFile('prism')
            ->hasViews()
            ->hasMigration('create_ai_seo_tables')
            ->hasCommand(AiSeoCommand::class);
    }

    public function packageRegistered(): void
    {
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