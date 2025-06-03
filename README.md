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

### 🛠️ Additional Features
- Multi-language support with translations
- Activity logging and monitoring
- Backup and restore functionality
- Analytics integration
- Webhook support
- Queue management
- Caching and performance optimization
- Permission management
- API rate limiting
- Error tracking and reporting
- Uptime monitoring
- Newsletter integration
- Google Calendar integration
- Slack notifications

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
    spatie/laravel-sitemap:^6.0 \
    spatie/laravel-robots-middleware:^2.0 \
    spatie/laravel-responsecache:^7.0 \
    spatie/laravel-feed:^4.0 \
    spatie/laravel-tags:^4.0 \
    spatie/laravel-sluggable:^3.0 \
    spatie/laravel-permission:^6.0 \
    spatie/laravel-backup:^8.0 \
    spatie/laravel-activitylog:^4.0 \
    spatie/laravel-analytics:^4.0 \
    spatie/laravel-query-builder:^5.0 \
    spatie/laravel-collection-macros:^4.0 \
    spatie/laravel-cors:^3.0 \
    spatie/laravel-ignition:^2.0 \
    spatie/laravel-paginateroute:^4.0 \
    spatie/laravel-settings:^2.0 \
    spatie/laravel-translatable:^6.0 \
    spatie/laravel-validation-rules:^3.0 \
    spatie/laravel-webhook-client:^3.0 \
    spatie/laravel-webhook-server:^4.0 \
    spatie/laravel-query-string:^2.0 \
    spatie/laravel-route-attributes:^2.0 \
    spatie/laravel-schemaless-attributes:^2.0 \
    spatie/laravel-slack-alerts:^1.0 \
    spatie/laravel-google-calendar:^2.0 \
    spatie/laravel-newsletter:^5.0 \
    spatie/laravel-uptime-monitor:^4.0 \
    spatie/laravel-http-logger:^2.0 \
    spatie/laravel-queueable-action:^2.0
```

3. Publish the configuration files:

```bash
php artisan vendor:publish --tag=aiseo-config
php artisan vendor:publish --tag=prism-config
```

4. Run migrations:

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

# Additional Services
GOOGLE_ANALYTICS_ID="your-ga-id"
SLACK_WEBHOOK_URL="your-slack-webhook"
GOOGLE_CALENDAR_ID="your-calendar-id"
NEWSLETTER_API_KEY="your-newsletter-key"
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

### Additional Features

```php
// Activity Logging
AiSeo::logActivity('SEO Analysis Completed', [
    'url' => $url,
    'score' => $score,
]);

// Analytics Integration
AiSeo::trackPageView($url, [
    'title' => $title,
    'category' => 'blog',
]);

// Webhook Notifications
AiSeo::notifyWebhook('seo.analysis.completed', [
    'url' => $url,
    'results' => $results,
]);

// Queue Management
AiSeo::queueAnalysis($url, [
    'priority' => 'high',
    'retry' => 3,
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
