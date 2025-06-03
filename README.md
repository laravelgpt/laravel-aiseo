# Laravel AI SEO

[![Latest Version](https://img.shields.io/packagist/v/aiseo/laravel-aiseo.svg?style=flat-square)](https://packagist.org/packages/aiseo/laravel-aiseo)
[![Tests](https://github.com/laravelgpt/laravel-aiseo/actions/workflows/tests.yml/badge.svg)](https://github.com/laravelgpt/laravel-aiseo/actions/workflows/tests.yml)
[![Laravel Version](https://img.shields.io/badge/Laravel-10.x%20%7C%2011.x%20%7C%2012.x-orange.svg)](https://laravel.com)

Advanced AI-powered SEO package for Laravel with JSON-LD, OpenGraph, and Schema.org support.

## Features

### 🎯 Structured Data & Markup
- JSON-LD Schema.org markup generation
- OpenGraph meta tags automation
- Twitter Card meta tags
- Article, Product, Organization schemas
- BreadcrumbList and FAQPage schemas
- LocalBusiness and Event schemas
- Rich Snippets optimization

### 🤖 AI-Powered Automation
- Content analysis and optimization
- Keyword density analysis
- SEO score calculation
- Competitor analysis
- Title and meta description generation
- Image alt text optimization
- Internal linking suggestions
- Content gap analysis

### 🔄 Real-time Features
- Live SEO monitoring
- Performance tracking
- Automated sitemap generation
- Robots.txt management
- Canonical URL handling
- Mobile optimization checks
- Page speed analysis

## Requirements

- PHP >= 8.1
- Laravel ^10.0|^11.0|^12.0
- Composer 2.x

## Installation

1. Install the package via Composer:

```bash
composer require aiseo/laravel-aiseo
```

2. Install required dependencies:

```bash
composer require spatie/laravel-package-tools:^1.16 \
    spatie/laravel-html:^3.0 \
    spatie/laravel-ray:^2.0 \
    spatie/schema-org:^3.0 \
    guzzlehttp/guzzle:^7.0 \
    prism-php/prism:^1.0 \
    illuminate/support:^10.0|^11.0|^12.0 \
    illuminate/contracts:^10.0|^11.0|^12.0
```

3. Publish the configuration files:

```bash
php artisan vendor:publish --tag=aiseo-config
php artisan vendor:publish --tag=prism-config
```

4. Run migrations (if any):

```bash
php artisan migrate
```

## Configuration

Add to your `.env` file:

```env
# AI SEO Configuration
AISEO_DEFAULT_AUTHOR="Your Name"
AISEO_PUBLISHER_NAME="Your Company"
AISEO_LOGO_URL="https://your-domain.com/logo.png"
AISEO_OPENAI_API_KEY="your-openai-key"

# Prism Configuration
PRISM_API_KEY="your-prism-api-key"
PRISM_API_URL="https://api.prism.ai"
PRISM_DEFAULT_MODEL="gpt-4"
PRISM_CACHE_ENABLED=true
PRISM_CACHE_TTL=3600
```

## Usage

### Basic Schema Generation

```php
use AiSeo\LaravelAiSeo\AiSeoFacade as AiSeo;

// Generate Article Schema
$schema = AiSeo::generateArticleSchema([
    'title' => 'Your Title',
    'description' => 'Your Description',
    'url' => 'https://your-domain.com/article',
    'author' => 'Author Name',
    'published_at' => now(),
    'modified_at' => now(),
    'image' => 'https://your-domain.com/image.jpg',
]);

// Generate Product Schema
$productSchema = AiSeo::generateProductSchema([
    'name' => 'Product Name',
    'description' => 'Product Description',
    'price' => 99.99,
    'currency' => 'USD',
    'availability' => 'InStock',
    'brand' => 'Brand Name',
]);

// Generate Organization Schema
$orgSchema = AiSeo::generateOrganizationSchema([
    'name' => 'Company Name',
    'url' => 'https://your-domain.com',
    'logo' => 'https://your-domain.com/logo.png',
    'sameAs' => [
        'https://facebook.com/yourcompany',
        'https://twitter.com/yourcompany',
    ],
]);
```

### AI-Powered Analysis

```php
// Content Analysis
$analysis = AiSeo::analyzeContent($content, 'prism', [
    'api_key' => config('prism.api_key'),
    'model' => config('prism.models.default'),
    'cache' => config('prism.cache.enabled'),
]);

// Generate SEO-optimized Title
$title = AiSeo::generateSeoTitle($content, [
    'max_length' => 60,
    'include_brand' => true,
]);

// Generate Meta Description
$description = AiSeo::generateMetaDescription($content, [
    'max_length' => 160,
    'include_keywords' => true,
]);

// Analyze Keyword Density
$keywords = AiSeo::analyzeKeywordDensity($content, [
    'min_length' => 3,
    'exclude_common' => true,
]);
```

### Real-time API Integration

```php
// API Route for Real-time Analysis
Route::post('/api/seo/analyze', [SeoApiController::class, 'analyze']);

// Blade Component Usage
<x-aiseo::meta-tags 
    :title="$title"
    :description="$description"
    :keywords="$keywords"
    :schema="$schema"
/>

// Livewire Component
<livewire:aiseo::seo-analyzer 
    :content="$content"
    :url="$url"
/>
```

## AI Integration with Prism

This package supports advanced AI SEO analysis using [Prism PHP](https://github.com/prism-php/prism). You can use Prism as an AI provider for content analysis, keyword suggestions, and more.

Example:

```php
$analysis = AiSeo::analyzeContent($content, 'prism', [
    'api_key' => config('prism.api_key'),
    'model' => config('prism.models.default'),
    'cache' => config('prism.cache.enabled'),
]);
```

## Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING.md](CONTRIBUTING.md).

## License

The MIT License (MIT). See [License File](LICENSE.md).
