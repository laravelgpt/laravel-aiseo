# Laravel AI SEO

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravelgpt/laravel-aiseo.svg?style=flat-square)](https://packagist.org/packages/laravelgpt/laravel-aiseo)
[![Total Downloads](https://img.shields.io/packagist/dt/laravelgpt/laravel-aiseo.svg?style=flat-square)](https://packagist.org/packages/laravelgpt/laravel-aiseo)
[![Tests](https://github.com/laravelgpt/laravel-aiseo/actions/workflows/tests.yml/badge.svg)](https://github.com/laravelgpt/laravel-aiseo/actions/workflows/tests.yml)

An advanced AI-powered SEO tool for Laravel that provides comprehensive SEO optimization, structured data generation, and real-time analysis. This package integrates with Prism AI for enhanced content optimization and automated SEO improvements.

## Features

### Structured Data & Markup
- JSON-LD Schema.org markup generation
- OpenGraph meta tags automation
- Twitter Card meta tags
- Article, Product, Organization schemas
- BreadcrumbList and FAQPage schemas
- LocalBusiness and Event schemas
- Rich Snippets optimization

### AI-Powered Automation
- Content analysis and optimization
- Keyword density analysis
- SEO score calculation
- Competitor analysis
- Title and meta description generation
- Image alt text optimization
- Internal linking suggestions
- Content gap analysis

### Real-Time Features
- Live SEO monitoring
- Performance tracking
- Automated sitemap generation
- Robots.txt management
- Canonical URL handling
- Mobile optimization checks
- Page speed analysis

### Additional Features
- Multi-language support
- Activity logging
- Backup functionality
- Analytics integration
- Webhook support
- Queue management
- Caching and performance optimization
- Permission management
- API rate limiting
- Error tracking
- Uptime monitoring
- Newsletter integration
- Google Calendar integration
- Slack notifications

## Requirements

- PHP 8.1 or higher
- Laravel 10.x, 11.x, or 12.x
- Composer 2.x

## Installation

You can install the package via composer:

```bash
composer require laravelgpt/laravel-aiseo
```

After installing the package, publish the configuration file:

```bash
php artisan vendor:publish --provider="LaravelGPT\AiSeo\AiSeoServiceProvider"
```

### Required Dependencies

The package requires the following dependencies:

```bash
composer require spatie/laravel-sitemap:^6.0 \
    spatie/laravel-robots-middleware:^2.0 \
    spatie/laravel-responsecache:^7.0 \
    spatie/laravel-backup:^8.0 \
    spatie/laravel-activitylog:^4.0 \
    spatie/laravel-permission:^6.0 \
    spatie/laravel-slack-alerts:^1.0 \
    spatie/laravel-google-calendar:^4.0 \
    spatie/laravel-newsletter:^5.0 \
    spatie/laravel-webhook-client:^3.0 \
    spatie/laravel-uptime-monitor:^4.0 \
    spatie/laravel-analytics:^4.0 \
    spatie/laravel-queueable-action:^2.0 \
    spatie/laravel-query-builder:^5.0 \
    spatie/laravel-settings:^2.0 \
    spatie/laravel-tags:^4.0 \
    spatie/laravel-translatable:^6.0 \
    spatie/laravel-backup:^8.0 \
    spatie/laravel-activitylog:^4.0 \
    spatie/laravel-permission:^6.0 \
    spatie/laravel-slack-alerts:^1.0 \
    spatie/laravel-google-calendar:^4.0 \
    spatie/laravel-newsletter:^5.0 \
    spatie/laravel-webhook-client:^3.0 \
    spatie/laravel-uptime-monitor:^4.0 \
    spatie/laravel-analytics:^4.0 \
    spatie/laravel-queueable-action:^2.0 \
    spatie/laravel-query-builder:^5.0 \
    spatie/laravel-settings:^2.0 \
    spatie/laravel-tags:^4.0 \
    spatie/laravel-translatable:^6.0 \
    prism-php/prism:^1.0
```

## Configuration

Add the following to your `.env` file:

```env
AISEO_AUTHOR_NAME="Your Name"
AISEO_PUBLISHER_NAME="Your Company"
AISEO_LOGO_URL="https://example.com/logo.png"
AISEO_AI_API_KEY="your-ai-api-key"
AISEO_GOOGLE_ANALYTICS_ID="your-ga-id"
AISEO_SLACK_WEBHOOK_URL="your-slack-webhook"
AISEO_GOOGLE_CALENDAR_ID="your-calendar-id"
AISEO_NEWSLETTER_API_KEY="your-newsletter-api-key"
```

## Usage

### Generate Article Schema

```php
use LaravelGPT\AiSeo\Facades\AiSeo;

$schema = AiSeo::article()
    ->title('Your Article Title')
    ->description('Your article description')
    ->author('Author Name')
    ->publishDate(now())
    ->generate();
```

### Generate OpenGraph Tags

```php
use LaravelGPT\AiSeo\Facades\AiSeo;

$tags = AiSeo::openGraph()
    ->title('Your Page Title')
    ->description('Your page description')
    ->image('https://example.com/image.jpg')
    ->generate();
```

### Generate Meta Tags

```php
use LaravelGPT\AiSeo\Facades\AiSeo;

$tags = AiSeo::meta()
    ->title('Your Page Title')
    ->description('Your page description')
    ->keywords('keyword1, keyword2, keyword3')
    ->generate();
```

### AI-Powered Content Analysis

```php
use LaravelGPT\AiSeo\Facades\AiSeo;

$analysis = AiSeo::analyze()
    ->content('Your content here')
    ->keywords(['keyword1', 'keyword2'])
    ->generate();
```

### Real-Time SEO Analysis

```php
use LaravelGPT\AiSeo\Facades\AiSeo;

$analysis = AiSeo::realtime()
    ->url('https://example.com')
    ->analyze();
```

### In Blade Views

```php
@seo([
    'title' => 'Your Page Title',
    'description' => 'Your page description',
    'keywords' => 'keyword1, keyword2, keyword3',
    'author' => 'Author Name',
    'publishDate' => now(),
    'image' => 'https://example.com/image.jpg'
])
```

## Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email security@laravelgpt.com instead of using the issue tracker.

## Credits

- [LaravelGPT](https://github.com/laravelgpt)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
