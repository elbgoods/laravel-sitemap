<?php

namespace Elbgoods\LaravelSitemap\Tests\UrlMap;

use Elbgoods\LaravelSitemap\Tests\Dummies\Models\City;
use Elbgoods\LaravelSitemap\Tests\Dummies\Models\Vehicle;
use Elbgoods\LaravelSitemap\Tests\TestCase;
use Elbgoods\LaravelSitemap\UrlMap\ModelUrlMap;
use Elbgoods\LaravelSitemap\Xml\Document;

final class ModelUrlMapTest extends TestCase
{
    /** @test */
    public function it_add_all_models_to_the_sitemap(): void
    {
        $city1 = City::factory()->create();
        $city2 = City::factory()->create();

        $sitemap = new Document();
        $modelSitemap = new ModelUrlMap(City::class);

        $modelSitemap->addToDocument($sitemap);

        $urlNodes = $sitemap->getDocument()->getElementsByTagName('url');
        $this->assertCount(2, $urlNodes);
        $this->assertEquals(
            $city1->getSitemapUrl(),
            $urlNodes->item(0)->getElementsByTagName('loc')->item(0)->textContent
        );
        $this->assertEquals(
            $city2->getSitemapUrl(),
            $urlNodes->item(1)->getElementsByTagName('loc')->item(0)->textContent
        );
    }

    /** @test */
    public function it_applies_custom_sitemap_query(): void
    {
        $product = Vehicle::factory()->create(['type' => 'Land']);
        Vehicle::factory()->create(['type' => 'Water']);

        $sitemap = new Document();
        $modelSitemap = new ModelUrlMap(Vehicle::class);

        $modelSitemap->addToDocument($sitemap);

        $urlNodes = $sitemap->getDocument()->getElementsByTagName('url');
        $this->assertCount(1, $urlNodes);
        $this->assertEquals(
            $product->getSitemapUrl(),
            $urlNodes->item(0)->getElementsByTagName('loc')->item(0)->textContent
        );
    }
}
