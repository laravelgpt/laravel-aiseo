# Laravel AI SEO

Advanced AI-powered SEO package for Laravel with JSON-LD, OpenGraph, and Schema.org support. This package helps you generate SEO-optimized structured data for your AI-generated content.

## Features

- 🎯 JSON-LD Schema.org markup generation
- 🔍 OpenGraph meta tags for social media
- 📝 Meta tags generation
- 📊 Content analysis with SEO scoring
- 🗺️ XML sitemap generation
- 🔄 Caching support
- 🧪 Comprehensive test suite
- 🚀 Laravel 10/11 support

## Installation

You can install the package via composer:

```bash
composer require aiseo/laravel-aiseo
```

The package will automatically register its service provider.

You can publish the config file with:

```bash
php artisan vendor:publish --provider="AiSeo\LaravelAiSeo\AiSeoServiceProvider" --tag="aiseo-config"
```

This will create a `config/aiseo.php` file in your app that you can modify to set your configuration.

## Configuration

Add the following to your `.env` file:

```env
AISEO_DEFAULT_AUTHOR="Your Author Name"
AISEO_PUBLISHER_NAME="Your Company Name"
AISEO_LOGO_URL="https://your-domain.com/logo.png"
```

## Usage

### Generate Article Schema

```php
use AiSeo\LaravelAiSeo\AiSeoFacade as AiSeo;

$schema = AiSeo::generateArticleSchema([
    'title' => 'Your Article Title',
    'description' => 'Your article description',
    'url' => 'https://your-domain.com/article',
    'image' => 'https://your-domain.com/article-image.jpg',
    'keywords' => 'keyword1, keyword2, keyword3',
]);
```

### Generate OpenGraph Tags

```php
$og = AiSeo::generateOpenGraph([
    'title' => 'Your Article Title',
    'description' => 'Your article description',
    'url' => 'https://your-domain.com/article',
    'image' => 'https://your-domain.com/article-image.jpg',
    'type' => 'article',
    'site_name' => 'Your Site Name',
]);
```

### Generate Meta Tags

```php
$meta = AiSeo::generateMetaTags([
    'description' => 'Your page description',
    'keywords' => 'keyword1, keyword2, keyword3',
    'author' => 'Your Name',
    'robots' => 'index, follow',
]);
```

### Analyze Content

```php
$analysis = AiSeo::analyzeContent($yourContent);

// Returns:
[
    'word_count' => 500,
    'reading_time' => 3, // minutes
    'keyword_density' => [
        'keyword1' => 2.5,
        'keyword2' => 1.8,
        // ...
    ],
    'seo_score' => 85
]
```

### Generate Sitemap

```php
$urls = [
    [
        'loc' => 'https://your-domain.com/page1',
        'lastmod' => '2024-01-01',
        'changefreq' => 'daily',
        'priority' => '1.0',
    ],
    // ...
];

$sitemap = AiSeo::generateSitemap($urls);
```

### Using in Blade Views

```php
<!DOCTYPE html>
<html>
<head>
    <title>{{ $article->title }}</title>
    
    {!! AiSeo::generateMetaTags([
        'description' => $article->description,
        'keywords' => $article->keywords,
    ]) !!}
    
    {!! AiSeo::generateOpenGraph([
        'title' => $article->title,
        'description' => $article->description,
        'url' => route('articles.show', $article),
        'image' => $article->featured_image,
    ]) !!}
    
    {!! AiSeo::generateArticleSchema([
        'title' => $article->title,
        'description' => $article->description,
        'url' => route('articles.show', $article),
        'image' => $article->featured_image,
    ]) !!}
</head>
<body>
    <!-- Your content here -->
</body>
</html>
```

## Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email info@aiseo.dev instead of using the issue tracker.

## Credits

- [AI SEO LaravelGpt](https://github.com/laravelgpt)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information. 