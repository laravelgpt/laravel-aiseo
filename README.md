# Laravel AI SEO

[![Latest Version](https://img.shields.io/packagist/v/aiseo/laravel-aiseo.svg?style=flat-square)](https://packagist.org/packages/aiseo/laravel-aiseo)
[![Tests](https://github.com/laravelgpt/laravel-aiseo/actions/workflows/tests.yml/badge.svg)](https://github.com/laravelgpt/laravel-aiseo/actions/workflows/tests.yml)

Advanced AI-powered SEO package for Laravel with JSON-LD, OpenGraph, and Schema.org support.

## Features

- 🎯 JSON-LD Schema.org markup
- 🔍 OpenGraph meta tags
- 📝 Meta tags generation
- 📊 Content analysis with SEO scoring
- 🗺️ XML sitemap generation
- 🤖 AI-powered SEO analysis
- 🔄 Real-time SEO analysis
- 🧪 Comprehensive test suite

## Installation

```bash
composer require aiseo/laravel-aiseo
```

## Configuration

Add to `.env`:
```env
AISEO_DEFAULT_AUTHOR="Your Name"
AISEO_PUBLISHER_NAME="Your Company"
AISEO_LOGO_URL="https://your-domain.com/logo.png"
AISEO_OPENAI_API_KEY="your-openai-key"
```

## Usage

```php
use AiSeo\LaravelAiSeo\AiSeoFacade as AiSeo;

// Generate Schema
$schema = AiSeo::generateArticleSchema([
    'title' => 'Your Title',
    'description' => 'Your Description',
    'url' => 'https://your-domain.com/article',
]);

// AI Analysis
$analysis = AiSeo::analyzeContent($content, 'openai');

// Real-time API
Route::post('/api/seo/analyze', [SeoApiController::class, 'analyze']);
```

## Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING.md](CONTRIBUTING.md).

## License

The MIT License (MIT). See [License File](LICENSE.md).
