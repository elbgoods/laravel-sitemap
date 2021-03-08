<?php

namespace Elbgoods\LaravelSitemap\Tests\Commands\Sitemap;

use Elbgoods\LaravelSitemap\Tests\Dummies\Models\City;
use Elbgoods\LaravelSitemap\Tests\TestCase;
use Elbgoods\LaravelSitemap\Url\ModelSitemapUrl;
use Elbgoods\LaravelSitemap\Url\StaticPageSitemapUrl;
use Elbgoods\LaravelSitemap\Xml\Document;
use Illuminate\Support\Facades\Config;

final class GenerateCommandTest extends TestCase
{
    /** @test */
    public function it_creates_sitemap_from_config(): void
    {
        $city = City::factory()->create();

        Config::set('sitemap', [
            ['loc' => 'https://example.com/faq'],
            City::class,
        ]);

        $expected = new Document();
        $expected->addSitemapUrl(new StaticPageSitemapUrl(['loc' => 'https://example.com/faq']));
        $expected->addSitemapUrl(new ModelSitemapUrl($city));

        $this->artisan('sitemap:generate')
            ->expectsOutput($expected->toXml())
            ->assertExitCode(0);
    }
}
