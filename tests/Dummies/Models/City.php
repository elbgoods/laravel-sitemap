<?php

namespace Elbgoods\LaravelSitemap\Tests\Dummies\Models;

use Elbgoods\LaravelSitemap\Contracts\Sitemap;
use Elbgoods\LaravelSitemap\Database\Factories\CityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class City extends Model implements Sitemap
{
    use HasFactory;

    public static function newFactory()
    {
        return new CityFactory();
    }

    public function getSitemapUrl(): string
    {
        return 'https://example.com/cities/'.$this->id;
    }
}
