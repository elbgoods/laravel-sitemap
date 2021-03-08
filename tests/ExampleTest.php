<?php

namespace Elbgoods\LaravelSitemap\Tests;

use Orchestra\Testbench\TestCase;
use Elbgoods\LaravelSitemap\LaravelSitemapServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [LaravelSitemapServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
