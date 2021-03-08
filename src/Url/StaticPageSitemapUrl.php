<?php

namespace Elbgoods\LaravelSitemap\Url;

use Carbon\Carbon;
use Elbgoods\LaravelSitemap\Contracts\SitemapUrl;

final class StaticPageSitemapUrl implements SitemapUrl
{
    protected array $sitemapUrlData;

    /**
     * @param array<string, mixed> $sitemapUrlData
     */
    public function __construct(array $sitemapUrlData)
    {
        $this->sitemapUrlData = $sitemapUrlData;
    }

    public function loc(): string
    {
        return $this->sitemapUrlData['loc'];
    }

    public function lastmod(): Carbon
    {
        return $this->sitemapUrlData['lastmod'] ?? Carbon::now();
    }

    public function priority(): float
    {
        return $this->sitemapUrlData['priority'] ?? 0.5;
    }

    public function changefreq(): string
    {
        return $this->sitemapUrlData['changefreq'] ?? SitemapUrl::DAILY;
    }
}
