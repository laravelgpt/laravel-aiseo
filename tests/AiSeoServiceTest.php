<?php

namespace AiSeo\LaravelAiSeo\Tests;

use AiSeo\LaravelAiSeo\AiSeoService;
use Illuminate\Config\Repository;
use Orchestra\Testbench\TestCase;

class AiSeoServiceTest extends TestCase
{
    protected AiSeoService $service;
    protected Repository $config;

    protected function setUp(): void
    {
        parent::setUp();

        $this->config = new Repository([
            'aiseo' => [
                'default_author' => 'Test Author',
                'publisher_name' => 'Test Publisher',
                'logo_url' => 'https://test.com/logo.png',
            ],
        ]);

        $this->service = new AiSeoService($this->config);
    }

    public function test_generate_article_schema(): void
    {
        $data = [
            'title' => 'Test Article',
            'description' => 'Test Description',
            'url' => 'https://test.com/article',
        ];

        $schema = $this->service->generateArticleSchema($data);
        
        $this->assertStringContainsString('https://schema.org', $schema);
        $this->assertStringContainsString('Test Article', $schema);
        $this->assertStringContainsString('Test Description', $schema);
        $this->assertStringContainsString('Test Author', $schema);
        $this->assertStringContainsString('Test Publisher', $schema);
    }

    public function test_generate_open_graph(): void
    {
        $data = [
            'title' => 'Test Article',
            'description' => 'Test Description',
            'url' => 'https://test.com/article',
            'image' => 'https://test.com/image.jpg',
        ];

        $og = $this->service->generateOpenGraph($data);

        $this->assertStringContainsString('og:title', $og);
        $this->assertStringContainsString('og:description', $og);
        $this->assertStringContainsString('og:type', $og);
        $this->assertStringContainsString('og:url', $og);
        $this->assertStringContainsString('og:image', $og);
    }

    public function test_generate_meta_tags(): void
    {
        $data = [
            'description' => 'Test Description',
            'keywords' => 'test, keywords',
            'author' => 'Test Author',
        ];

        $meta = $this->service->generateMetaTags($data);

        $this->assertStringContainsString('description', $meta);
        $this->assertStringContainsString('keywords', $meta);
        $this->assertStringContainsString('author', $meta);
        $this->assertStringContainsString('robots', $meta);
        $this->assertStringContainsString('viewport', $meta);
    }

    public function test_analyze_content(): void
    {
        $content = '
            <h1>Test Article</h1>
            <p>This is a test article with some content.</p>
            <img src="test.jpg" alt="Test Image">
            <a href="https://test.com">Test Link</a>
        ';

        $analysis = $this->service->analyzeContent($content);

        $this->assertIsArray($analysis);
        $this->assertArrayHasKey('word_count', $analysis);
        $this->assertArrayHasKey('reading_time', $analysis);
        $this->assertArrayHasKey('keyword_density', $analysis);
        $this->assertArrayHasKey('seo_score', $analysis);
        $this->assertGreaterThan(0, $analysis['seo_score']);
    }

    public function test_generate_sitemap(): void
    {
        $urls = [
            [
                'loc' => 'https://test.com/page1',
                'lastmod' => '2024-01-01',
                'changefreq' => 'daily',
                'priority' => '1.0',
            ],
            [
                'loc' => 'https://test.com/page2',
                'lastmod' => '2024-01-02',
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ],
        ];

        $sitemap = $this->service->generateSitemap($urls);

        $this->assertStringContainsString('<?xml version="1.0" encoding="UTF-8"?>', $sitemap);
        $this->assertStringContainsString('https://test.com/page1', $sitemap);
        $this->assertStringContainsString('https://test.com/page2', $sitemap);
        $this->assertStringContainsString('daily', $sitemap);
        $this->assertStringContainsString('weekly', $sitemap);
    }
} 