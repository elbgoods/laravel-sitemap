<?php

namespace Elbgoods\LaravelSitemap;

use Elbgoods\LaravelSitemap\Url\StaticPageSitemapUrl;
use Elbgoods\LaravelSitemap\UrlMap\ModelUrlMap;
use Elbgoods\LaravelSitemap\Xml\Document;

final class Sitemap
{
    protected array $config;

    public function __construct()
    {
        $this->config = config('sitemap', []);
    }

    /**
     * @param array<int,string|array<string,mixed>> $config
     */
    public function config(array $config): self
    {
        $this->config = $config;

        return $this;
    }

    public function toXml(): string
    {
        $sitemap = new Document();

        foreach ($this->config as $sitemapUrlConfig) {
            if (is_array($sitemapUrlConfig)) {
                $sitemap->addSitemapUrl(new StaticPageSitemapUrl($sitemapUrlConfig));
            } elseif (is_string($sitemapUrlConfig)) {
                (new ModelUrlMap($sitemapUrlConfig))->addToDocument($sitemap);
            }
        }

        return $sitemap->toXml();
    }
}
