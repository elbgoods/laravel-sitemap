<?php

namespace Elbgoods\LaravelSitemap\Tests\Unit\Url;

use Elbgoods\LaravelSitemap\Contracts\SitemapUrl;
use Elbgoods\LaravelSitemap\Tests\TestCase;
use Elbgoods\LaravelSitemap\Url\StaticPageSitemapUrl;
use Illuminate\Support\Carbon;

final class StaticPageSitemapUrlTest extends TestCase
{
    /** @test */
    public function it_creates_static_sitemap_url(): void
    {
        $updatedAt = Carbon::yesterday();

        $sidemapUrl = new StaticPageSitemapUrl([
            'loc' => 'https://example.com/somewhere',
            'lastmod' => $updatedAt,
            'priority' => 0.9,
            'changefreq' => SitemapUrl::MONTHLY,
        ]);

        $this->assertEquals('https://example.com/somewhere', $sidemapUrl->loc());
        $this->assertEquals($updatedAt, $sidemapUrl->lastmod());
        $this->assertEquals(0.9, $sidemapUrl->priority());
        $this->assertEquals(SitemapUrl::MONTHLY, $sidemapUrl->changefreq());
    }

    /** @test */
    public function it_creates_static_sitemap_url_with_default_values(): void
    {
        Carbon::setTestNow(Carbon::now());

        $sidemapUrl = new StaticPageSitemapUrl([
            'loc' => 'https://example.com/somewhere',
        ]);

        $this->assertEquals('https://example.com/somewhere', $sidemapUrl->loc());
        $this->assertEquals(Carbon::now(), $sidemapUrl->lastmod());
        $this->assertEquals(0.5, $sidemapUrl->priority());
        $this->assertEquals(SitemapUrl::DAILY, $sidemapUrl->changefreq());

        Carbon::setTestNow();
    }
}
