<?php

namespace Elbgoods\LaravelSitemap\Contracts;

use Carbon\Carbon;

interface SitemapUrl
{
    public const ALWAYS = 'always';
    public const HOURLY = 'hourly';
    public const DAILY = 'daily';
    public const WEEKLY = 'weekly';
    public const MONTHLY = 'monthly';
    public const YEARLY = 'yearly';
    public const NEVER = 'never';

    public function loc(): string;

    public function lastmod(): Carbon;

    public function priority(): float;

    public function changefreq(): string;
}
