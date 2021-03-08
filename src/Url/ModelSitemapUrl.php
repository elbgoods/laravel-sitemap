<?php

namespace Elbgoods\LaravelSitemap\Url;

use Carbon\Carbon;
use Elbgoods\LaravelSitemap\Contracts\Sitemap;
use Elbgoods\LaravelSitemap\Contracts\SitemapUrl;

final class ModelSitemapUrl implements SitemapUrl
{
    protected Sitemap $model;

    public function __construct(Sitemap $model)
    {
        $this->model = $model;
    }

    public function loc(): string
    {
        return $this->model->getSitemapUrl();
    }

    public function lastmod(): Carbon
    {
        return $this->model->updated_at ?? Carbon::now();
    }

    public function priority(): float
    {
        return 0.5;
    }

    public function changefreq(): string
    {
        return SitemapUrl::DAILY;
    }
}
