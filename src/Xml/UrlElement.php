<?php

namespace Elbgoods\LaravelSitemap\Xml;

use DOMElement;
use Elbgoods\LaravelSitemap\Contracts\SitemapUrl;
use InvalidArgumentException;
use ReflectionClass;

final class UrlElement
{
    protected Document $document;
    protected SitemapUrl $sitemapUrl;

    public function __construct(Document $document, SitemapUrl $sitemapUrl)
    {
        $this->document = $document;
        $this->sitemapUrl = $sitemapUrl;
    }

    public function getXmlNode(): DOMElement
    {
        $urlNode = $this->document->getDocument()->createElement('url');

        $this->addNode($urlNode, 'loc', $this->sitemapUrl->loc());
        $this->addNode($urlNode, 'lastmod', $this->sitemapUrl->lastmod()->toRfc3339String());
        $this->addNode($urlNode, 'priority', strval($this->validatePriority($this->sitemapUrl->priority())));
        $this->addNode($urlNode, 'changefreq', $this->validateChangefreq($this->sitemapUrl->changefreq()));

        return $urlNode;
    }

    protected function addNode(DOMElement $urlNode, string $tag, string $value): void
    {
        $element = $this->document->getDocument()->createElement($tag, $value);
        $urlNode->appendChild($element);
    }

    protected function validatePriority(float $priority): float
    {
        if ($priority > 1 || $priority < 0) {
            throw new InvalidArgumentException('Priority MUST be between 0.0 and 1.0');
        }

        return $priority;
    }

    protected function validateChangefreq(string $changefreq): string
    {
        $changefreqConstants = (new ReflectionClass(SitemapUrl::class))->getConstants();

        if (! in_array($changefreq, $changefreqConstants)) {
            throw new InvalidArgumentException('Changefreq MUST be a valid sitemap changefreq value');
        }

        return $changefreq;
    }
}
