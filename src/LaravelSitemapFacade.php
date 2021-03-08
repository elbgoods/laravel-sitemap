<?php

namespace Elbgoods\LaravelSitemap;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Elbgoods\LaravelSitemap\Skeleton\SkeletonClass
 */
class LaravelSitemapFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-sitemap';
    }
}
