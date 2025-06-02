<?php

declare(strict_types=1);

namespace AiSeo\LaravelAiSeo;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Config as ConfigFacade;
use Illuminate\Support\Collection;
use Spatie\SchemaOrg\Schema;
use Spatie\SchemaOrg\Article;
use Spatie\SchemaOrg\Organization;
use Spatie\SchemaOrg\Person;
use Spatie\SchemaOrg\WebPage;
use Spatie\SchemaOrg\ImageObject;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

/**
 * Main SEO Service with AI API extensibility and real-time analysis foundation.
 */
class AiSeoService
{
    protected Config $config;
    protected Client $httpClient;
    protected array $cache = [];

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->httpClient = new Client([
            'timeout' => 5.0,
            'verify' => false
        ]);
    }

    /**
     * Generate Article Schema (JSON-LD)
     */
    public function generateArticleSchema(array $data): string
    {
        $defaults = [
            'author' => $this->config->get('aiseo.default_author'),
            'publisher' => $this->config->get('aiseo.publisher_name'),
            'logo' => $this->config->get('aiseo.logo_url'),
        ];
        $schema = array_merge($defaults, $data);

        $article = Schema::article()
            ->headline($schema['title'] ?? '')
            ->description($schema['description'] ?? '')
            ->image($schema['image'] ?? '')
            ->datePublished(Carbon::parse($schema['date_published'] ?? Carbon::now())->toIso8601String())
            ->dateModified(Carbon::parse($schema['date_modified'] ?? Carbon::now())->toIso8601String())
            ->author(Schema::person()->name($schema['author']))
            ->publisher(Schema::organization()
                ->name($schema['publisher'])
                ->logo(Schema::imageObject()->url($schema['logo']))
            )
            ->mainEntityOfPage(Schema::webPage()->url($schema['url'] ?? ''));

        if (isset($schema['keywords'])) {
            $article->keywords($schema['keywords']);
        }

        return $article->toScript();
    }

    /**
     * Generate OpenGraph meta tags
     */
    public function generateOpenGraph(array $data): string
    {
        $defaults = [
            'type' => 'article',
            'site_name' => $this->config->get('aiseo.publisher_name'),
        ];
        $og = array_merge($defaults, $data);
        $tags = [
            'og:title' => $og['title'] ?? '',
            'og:description' => $og['description'] ?? '',
            'og:type' => $og['type'],
            'og:url' => $og['url'] ?? '',
            'og:site_name' => $og['site_name'],
        ];
        if (isset($og['image'])) {
            $tags['og:image'] = $og['image'];
            $tags['og:image:alt'] = $og['image_alt'] ?? $og['title'] ?? '';
        }
        return Collection::make($tags)
            ->map(fn ($value, $key) => "<meta property=\"{$key}\" content=\"{$value}\" />")
            ->join("\n");
    }

    /**
     * Generate meta tags
     */
    public function generateMetaTags(array $data): string
    {
        $defaults = [
            'robots' => 'index, follow',
            'viewport' => 'width=device-width, initial-scale=1',
            'charset' => 'utf-8',
        ];
        $meta = array_merge($defaults, $data);
        $tags = [
            'description' => $meta['description'] ?? '',
            'keywords' => $meta['keywords'] ?? '',
            'author' => $meta['author'] ?? $this->config->get('aiseo.default_author'),
            'robots' => $meta['robots'],
            'viewport' => $meta['viewport'],
        ];
        return Collection::make($tags)
            ->map(fn ($value, $key) => "<meta name=\"{$key}\" content=\"{$value}\" />")
            ->join("\n");
    }

    /**
     * Analyze content with built-in heuristics and optional AI API
     */
    public function analyzeContent(string $content, ?string $aiProvider = null): array
    {
        $cacheKey = md5($content . $aiProvider);
        if (isset($this->cache[$cacheKey])) {
            return $this->cache[$cacheKey];
        }
        $analysis = [
            'word_count' => str_word_count(strip_tags($content)),
            'reading_time' => ceil(str_word_count(strip_tags($content)) / 200),
            'keyword_density' => $this->calculateKeywordDensity($content),
            'seo_score' => $this->calculateSeoScore($content),
        ];
        // If an AI provider is specified, enhance analysis
        if ($aiProvider) {
            $analysis['ai'] = $this->analyzeWithAiApi($content, $aiProvider);
        }
        $this->cache[$cacheKey] = $analysis;
        return $analysis;
    }

    /**
     * Integrate with external AI APIs (ChatGPT, DeepSeek, etc.)
     */
    public function analyzeWithAiApi(string $content, string $provider = 'openai', array $options = []): array
    {
        // Example: OpenAI/DeepSeek/Other API integration
        // This is a stub. You should implement actual API calls and error handling.
        $prompt = $options['prompt'] ?? 'Analyze this content for SEO:';
        $apiKey = $options['api_key'] ?? $this->config->get("aiseo.{$provider}_api_key");
        $endpoint = $options['endpoint'] ?? match ($provider) {
            'openai' => 'https://api.openai.com/v1/chat/completions',
            'deepseek' => 'https://api.deepseek.com/v1/seo',
            default => null,
        };
        if (!$endpoint || !$apiKey) {
            return ['error' => 'No API endpoint or key configured for provider: ' . $provider];
        }
        try {
            $response = $this->httpClient->post($endpoint, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => $options['model'] ?? 'gpt-3.5-turbo',
                    'messages' => [
                        ['role' => 'system', 'content' => $prompt],
                        ['role' => 'user', 'content' => $content],
                    ],
                ],
            ]);
            $result = json_decode((string) $response->getBody(), true);
            return $result;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Real-time SEO analysis API endpoint (for controller or Livewire/Volt use)
     */
    public function realTimeSeoAnalysis(string $content, ?string $aiProvider = null): array
    {
        // This can be called from a controller or Livewire/Volt component
        // Optionally broadcast results via events or websockets
        $result = $this->analyzeContent($content, $aiProvider);
        // TODO: Broadcast event for real-time UI update
        // event(new SeoAnalysisCompleted($result));
        return $result;
    }

    protected function calculateKeywordDensity(string $content): array
    {
        $words = str_word_count(strip_tags($content), 1);
        $wordCount = count($words);
        $density = [];
        foreach ($words as $word) {
            $word = strtolower($word);
            if (strlen($word) > 3) {
                $density[$word] = ($density[$word] ?? 0) + 1;
            }
        }
        return Collection::make($density)
            ->map(fn ($count) => ($count / $wordCount) * 100)
            ->sortDesc()
            ->take(10)
            ->toArray();
    }

    protected function calculateSeoScore(string $content): int
    {
        $score = 0;
        $wordCount = str_word_count(strip_tags($content));
        if ($wordCount >= 300) $score += 20;
        elseif ($wordCount >= 200) $score += 15;
        elseif ($wordCount >= 100) $score += 10;
        if (preg_match('/<h1[^>]*>(.*?)<\/h1>/i', $content)) $score += 10;
        if (preg_match('/<h2[^>]*>(.*?)<\/h2>/i', $content)) $score += 5;
        if (preg_match('/<h3[^>]*>(.*?)<\/h3>/i', $content)) $score += 5;
        if (preg_match('/<img[^>]*alt=["\'](.*?)["\'][^>]*>/i', $content)) $score += 10;
        if (preg_match('/<a[^>]*href=["\'](.*?)["\'][^>]*>/i', $content)) $score += 10;
        if (preg_match('/<meta[^>]*name=["\']description["\'][^>]*content=["\'](.*?)["\'][^>]*>/i', $content)) $score += 10;
        return min(100, $score);
    }

    /**
     * Generate XML sitemap
     */
    public function generateSitemap(array $urls): string
    {
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>');
        foreach ($urls as $url) {
            $urlNode = $xml->addChild('url');
            $urlNode->addChild('loc', $url['loc']);
            $urlNode->addChild('lastmod', $url['lastmod'] ?? Carbon::now()->toIso8601String());
            $urlNode->addChild('changefreq', $url['changefreq'] ?? 'weekly');
            $urlNode->addChild('priority', $url['priority'] ?? '0.8');
        }
        return $xml->asXML();
    }
} 