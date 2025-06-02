<?php

namespace AiSeo\LaravelAiSeo\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use AiSeo\LaravelAiSeo\AiSeoServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            AiSeoServiceProvider::class,
        ];
    }
} 