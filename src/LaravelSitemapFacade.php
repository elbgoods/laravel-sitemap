<?php

namespace Elbgoods\LaravelSitemap;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Elbgoods\LaravelSitemap\Skeleton\SkeletonClass
 */
class LaravelSitemapFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-sitemap';
    }
}
