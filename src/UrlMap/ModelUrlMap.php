<?php

namespace Elbgoods\LaravelSitemap\UrlMap;

use Elbgoods\LaravelSitemap\Url\ModelSitemapUrl;
use Elbgoods\LaravelSitemap\Xml\Document;

final class ModelUrlMap
{
    protected string $modelClass;

    public function __construct(string $modelClass)
    {
        $this->modelClass = $modelClass;
    }

    public function addToDocument(Document $document): void
    {
        $query = method_exists($this->modelClass, 'getSitemapQuery')
            ? $this->modelClass::getSitemapQuery()
            : $this->modelClass::query();

        foreach ($query->get() as $model) {
            $document->addSitemapUrl(new ModelSitemapUrl($model));
        }
    }
}
