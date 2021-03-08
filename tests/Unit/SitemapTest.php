<?php

namespace Elbgoods\LaravelSitemap\Tests\Unit\Sitemap;

use Elbgoods\LaravelSitemap\Sitemap;
use Elbgoods\LaravelSitemap\Tests\Dummies\Models\City;
use Elbgoods\LaravelSitemap\Tests\TestCase;
use Elbgoods\LaravelSitemap\Url\ModelSitemapUrl;
use Elbgoods\LaravelSitemap\Url\StaticPageSitemapUrl;
use Elbgoods\LaravelSitemap\Xml\Document;
use Illuminate\Support\Facades\Config;

final class SitemapTest extends TestCase
{
    /** @test */
    public function it_creates_sitemap_from_config_file(): void
    {
        $city = City::factory()->create();

        Config::set('sitemap', [
            ['loc' => 'https://example.com/faq'],
            City::class,
        ]);

        $sitemap = new Sitemap();

        $expected = new Document();
        $expected->addSitemapUrl(new StaticPageSitemapUrl(['loc' => 'https://example.com/faq']));
        $expected->addSitemapUrl(new ModelSitemapUrl($city));

        $this->assertEquals($expected->toXml(), $sitemap->toXml());
    }

    /** @test */
    public function it_creates_sitemap_from_custom_config(): void
    {
        $city = City::factory()->create();

        $config = [
            ['loc' => 'https://example.com/faq'],
            City::class,
        ];

        $sitemap = (new Sitemap())->config($config);

        $expected = new Document();
        $expected->addSitemapUrl(new StaticPageSitemapUrl(['loc' => 'https://example.com/faq']));
        $expected->addSitemapUrl(new ModelSitemapUrl($city));

        $this->assertEquals($expected->toXml(), $sitemap->toXml());
    }
}
