<?php

namespace Elbgoods\LaravelSitemap\Tests\Dummies\Models;

use Elbgoods\LaravelSitemap\Contracts\Sitemap;
use Elbgoods\LaravelSitemap\Database\Factories\FruitFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Fruit extends Model implements Sitemap
{
    use HasFactory;

    public $timestamps = false;

    public static function newFactory()
    {
        return new FruitFactory();
    }

    public function getSitemapUrl(): string
    {
        return 'https://example.com/fruits/'.$this->id;
    }
}
