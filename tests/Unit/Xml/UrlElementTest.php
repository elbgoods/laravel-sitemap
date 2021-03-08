<?php

namespace Elbgoods\LaravelSitemap\Tests\Unit\Xml;

use Carbon\Carbon;
use DOMElement;
use Elbgoods\LaravelSitemap\Contracts\SitemapUrl;
use Elbgoods\LaravelSitemap\Tests\Dummies\TestSiteMapUrl;
use Elbgoods\LaravelSitemap\Tests\TestCase;
use Elbgoods\LaravelSitemap\Xml\Document;
use Elbgoods\LaravelSitemap\Xml\UrlElement;
use InvalidArgumentException;

final class UrlElementTest extends TestCase
{
    /** @test */
    public function it_create_a_xml_sitemap_url_entry(): void
    {
        $sitemap = new Document();
        $sitemapUrl = new UrlElement($sitemap, new TestSiteMapUrl(0.8, SitemapUrl::ALWAYS));

        $urlNode = $sitemapUrl->getXmlNode();

        $this->assertInstanceOf(DOMElement::class, $urlNode);

        $this->assertEquals('url', $urlNode->tagName);

        $locNodes = $urlNode->getElementsByTagName('loc');
        $this->assertCount(1, $locNodes);

        $locNode = $locNodes->item(0);
        $this->assertEquals('https://bestattungsportal.com/agb', $locNode->textContent);

        $lastmodNodes = $urlNode->getElementsByTagName('lastmod');
        $this->assertCount(1, $lastmodNodes);

        $lastmodNode = $lastmodNodes->item(0);
        $this->assertEquals(Carbon::createFromFormat('Y-m-d', '2021-03-01')->toRfc3339String(), $lastmodNode->textContent);

        $priorityNodes = $urlNode->getElementsByTagName('priority');
        $this->assertCount(1, $priorityNodes);

        $priorityNode = $priorityNodes->item(0);
        $this->assertEquals('0.8', $priorityNode->textContent);

        $changeFreqNodes = $urlNode->getElementsByTagName('changefreq');
        $this->assertCount(1, $changeFreqNodes);

        $changeFreqNode = $changeFreqNodes->item(0);
        $this->assertEquals(SitemapUrl::ALWAYS, $changeFreqNode->textContent);
    }

    /** @test */
    public function it_raises_an_error_when_priority_is_not_between_0_and_1(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $sitemap = new Document();
        $sitemapUrl = new UrlElement($sitemap, new TestSiteMapUrl(1.8, SitemapUrl::ALWAYS));

        $sitemapUrl->getXmlNode();

        $this->expectException(InvalidArgumentException::class);

        $sitemap = new Document();
        $sitemapUrl = new UrlElement($sitemap, new TestSiteMapUrl(-0.1, SitemapUrl::ALWAYS));

        $sitemapUrl->getXmlNode();
    }

    /** @test */
    public function it_raises_an_error_when_changefreq_has_no_specified_value(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $sitemap = new Document();
        $sitemapUrl = new UrlElement($sitemap, new TestSiteMapUrl(0.8, 'sausagedog'));

        $sitemapUrl->getXmlNode();
    }
}
