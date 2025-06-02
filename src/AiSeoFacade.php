<?php

namespace AiSeo\LaravelAiSeo;

use Illuminate\Support\Facades\Facade;

class AiSeoFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'aiseo';
    }
} 