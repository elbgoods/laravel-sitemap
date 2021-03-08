<?php

namespace Elbgoods\LaravelSitemap\Tests\Unit;

use Elbgoods\LaravelSitemap\LaravelSitemapFacade;
use Elbgoods\LaravelSitemap\Tests\Dummies\Models\City;
use Elbgoods\LaravelSitemap\Tests\TestCase;
use Elbgoods\LaravelSitemap\Url\ModelSitemapUrl;
use Elbgoods\LaravelSitemap\Url\StaticPageSitemapUrl;
use Elbgoods\LaravelSitemap\Xml\Document;
use Illuminate\Support\Facades\Config;

final class LaravelSitemapFacadeTest extends TestCase
{
    /** @test */
    public function it_has_access_to_sitemap_via_facade(): void
    {
        $city = City::factory()->create();

        Config::set('sitemap', [
            ['loc' => 'https://example.com/faq'],
            City::class,
        ]);

        $expected = new Document();
        $expected->addSitemapUrl(new StaticPageSitemapUrl(['loc' => 'https://example.com/faq']));
        $expected->addSitemapUrl(new ModelSitemapUrl($city));

        $this->assertEquals($expected->toXml(), LaravelSitemapFacade::toXml());
    }
}
