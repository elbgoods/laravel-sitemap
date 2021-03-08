<?php

namespace Elbgoods\LaravelSitemap\Xml;

use DOMDocument;
use DOMElement;
use Elbgoods\LaravelSitemap\Contracts\SitemapUrl;

final class Document
{
    protected DOMDocument $document;
    protected DOMElement $urlset;

    public function __construct()
    {
        $this->document = new DOMDocument('1.0', 'utf-8');

        $this->urlset = $this->document->createElementNS($this->getSitemapNamespace(), 'urlset');
        $this->document->appendChild($this->urlset);
    }

    public function getDocument(): DOMDocument
    {
        return $this->document;
    }

    public function toXml(): string
    {
        return $this->document->saveXML();
    }

    public function addSitemapUrl(SitemapUrl $sitemapUrl): void
    {
        $urlXmlElement = new UrlElement($this, $sitemapUrl);
        $this->urlset->appendChild($urlXmlElement->getXmlNode());
    }

    public function getSitemapNamespace(): string
    {
        return 'http://www.sitemaps.org/schemas/sitemap/0.9';
    }
}
