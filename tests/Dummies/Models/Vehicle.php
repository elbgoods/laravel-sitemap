<?php

namespace Elbgoods\LaravelSitemap\Tests\Dummies\Models;

use Elbgoods\LaravelSitemap\Contracts\Sitemap;
use Elbgoods\LaravelSitemap\Database\Factories\VehicleFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Vehicle extends Model implements Sitemap
{
    use HasFactory;

    public static function newFactory()
    {
        return new VehicleFactory();
    }

    public static function getSitemapQuery(): Builder
    {
        return self::query()->whereType('Land');
    }

    public function getSitemapUrl(): string
    {
        return 'https://example.com/vehicles/'.$this->id;
    }
}
