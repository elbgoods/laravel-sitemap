<?php

namespace Elbgoods\LaravelSitemap\Tests\Dummies;

use Carbon\Carbon;
use Elbgoods\LaravelSitemap\Contracts\SitemapUrl;

final class TestSiteMapUrl implements SitemapUrl
{
    private string $changeFreq;
    private float $priority;

    public function __construct(float $priority, string $changeFreq)
    {
        $this->changeFreq = $changeFreq;
        $this->priority = $priority;
    }

    public function loc(): string
    {
        return 'https://bestattungsportal.com/agb';
    }

    public function lastmod(): Carbon
    {
        return Carbon::createFromFormat('Y-m-d', '2021-03-01');
    }

    public function priority(): float
    {
        return $this->priority;
    }

    public function changefreq(): string
    {
        return $this->changeFreq;
    }
}
