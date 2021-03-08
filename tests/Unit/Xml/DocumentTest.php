<?php

namespace Elbgoods\LaravelSitemap\Tests\Unit\Xml;

use Elbgoods\LaravelSitemap\Contracts\SitemapUrl;
use Elbgoods\LaravelSitemap\Tests\Dummies\TestSiteMapUrl;
use Elbgoods\LaravelSitemap\Tests\TestCase;
use Elbgoods\LaravelSitemap\Xml\Document;

final class DocumentTest extends TestCase
{
    /** @test */
    public function it_creates_empty_sitemap(): void
    {
        $sitemap = new Document();

        $document = $sitemap->getDocument();

        $urlsets = $document->getElementsByTagName('urlset');
        $this->assertCount(1, $urlsets);

        $urlset = $urlsets->item(0);
        $this->assertEquals('urlset', $urlset->tagName);
        $this->assertEquals('http://www.sitemaps.org/schemas/sitemap/0.9', $urlset->namespaceURI);

        $this->assertEquals($document->saveXml(), $sitemap->toXml());
    }

    /** @test */
    public function it_adds_sitemap_url(): void
    {
        $sitemapUrl = new TestSiteMapUrl(0.8, SitemapUrl::ALWAYS);
        $sitemap = new Document();

        $sitemap->addSitemapUrl($sitemapUrl);

        $this->assertCount(1, $sitemap->getDocument()->getElementsByTagName('url'));
        $got = $sitemap->getDocument()->getElementsByTagName('url')->item(0);
        $this->assertNotNull($got);
    }
}
