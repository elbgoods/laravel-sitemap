<?php

namespace Elbgoods\LaravelSitemap\Commands\Sitemap;

use Elbgoods\LaravelSitemap\LaravelSitemapFacade;
use Illuminate\Console\Command;

final class GenerateCommand extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generates a sitemap';

    public function handle(): void
    {
        $this->line(LaravelSitemapFacade::toXml());
    }
}
