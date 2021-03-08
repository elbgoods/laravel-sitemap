<?php

namespace Elbgoods\LaravelSitemap\Tests\Unit\Url;

use Carbon\Carbon;
use Elbgoods\LaravelSitemap\Contracts\SitemapUrl;
use Elbgoods\LaravelSitemap\Tests\Dummies\Models\City;
use Elbgoods\LaravelSitemap\Tests\Dummies\Models\Fruit;
use Elbgoods\LaravelSitemap\Tests\TestCase;
use Elbgoods\LaravelSitemap\Url\ModelSitemapUrl;

final class ModelSitemapUrlTest extends TestCase
{
    /** @test */
    public function it_creates_sitemap_url_from_model(): void
    {
        $updatedAt = Carbon::yesterday();

        $city = City::factory()->create(['updated_at' => $updatedAt]);

        $modelSitemapUrl = new ModelSitemapUrl($city);

        $this->assertEquals($city->getSitemapUrl(), $modelSitemapUrl->loc());
        $this->assertEquals($updatedAt, $modelSitemapUrl->lastmod());
        $this->assertEquals(0.5, $modelSitemapUrl->priority());
        $this->assertEquals(SitemapUrl::DAILY, $modelSitemapUrl->changefreq());
    }

    /** @test */
    public function it_uses_now_as_lastmod_when_not_updated_at_exists(): void
    {
        Carbon::setTestNow(Carbon::yesterday());

        $city = Fruit::factory()->create();

        $modelSitemapUrl = new ModelSitemapUrl($city);

        $this->assertEquals($city->getSitemapUrl(), $modelSitemapUrl->loc());
        $this->assertEquals(Carbon::now(), $modelSitemapUrl->lastmod());
        $this->assertEquals(0.5, $modelSitemapUrl->priority());
        $this->assertEquals(SitemapUrl::DAILY, $modelSitemapUrl->changefreq());

        Carbon::setTestNow();
    }
}
