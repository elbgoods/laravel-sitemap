# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/elbgoods/laravel-sitemap.svg?style=flat-square)](https://packagist.org/packages/elbgoods/laravel-sitemap)
[![Build Status](https://img.shields.io/travis/elbgoods/laravel-sitemap/master.svg?style=flat-square)](https://travis-ci.org/elbgoods/laravel-sitemap)
[![Quality Score](https://img.shields.io/scrutinizer/g/elbgoods/laravel-sitemap.svg?style=flat-square)](https://scrutinizer-ci.com/g/elbgoods/laravel-sitemap)
[![Total Downloads](https://img.shields.io/packagist/dt/elbgoods/laravel-sitemap.svg?style=flat-square)](https://packagist.org/packages/elbgoods/laravel-sitemap)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require elbgoods/laravel-sitemap
```

## Configuration and Usage

At first create a config file `config/sitemap.php` or get a bolilerplate file using
```bash
php artisan vendor:publish --provider="Elbgoods\LaravelSitemap\LaravelSitemapServiceProvider" --tag=config
```

### Add single page to sitemap

A Sitemap url entry is represented by an array with following layout:
```php
[
    'loc' => 'https://example.com/terms', // (required) url of the page,
    'lastmod' => Carbon::yesterday(), // (optional) last page modification
    'priority' => 0.9, // (optional) site priority
    'changefreq' => SitepageUrl::daily // (optional) page change frequency
]
```

### Add pages for models

You can create a sitepage entry of each model item (e.g. all products if your store) by adding the model class name to the sitepage configuration array.

Your Model MUST implement the `Elbgoods\LaravelSitemap\Contracts\Sitemap` interface.
This interface contains the method `getSitemapUrl()` which has to return the specific url for that model.

By default all model items will be entered in the sitemap.  
You can filter the model items by using this function:
```php
public static function getSitemapQuery(): Builder
```

### Generating Sitemap
You can generate a sitemap manually with this artisan command:
```bash
php artisan sitemap:generate > sitemap.xml
```

or use the Schedular:
```php
$schedule->command('sitemap:generate')
    ->daily()
    ->sendOutputTo($filePath);
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email nschirrmeister@elbgoods.de instead of using the issue tracker.

## Credits

- [Niclas Schirrmeister](https://github.com/elbgoods)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Treeware

You're free to use this package, but if it makes it to your production environment we would highly appreciate you buying or planting the world a tree.

It’s now common knowledge that one of the best tools to tackle the climate crisis and keep our temperatures from rising above 1.5C is to [plant trees](https://www.bbc.co.uk/news/science-environment-48870920). If you contribute to my forest you’ll be creating employment for local families and restoring wildlife habitats.

You can buy trees at [offset.earth/treeware](https://plant.treeware.earth/elbgoods/laravel-trashmail-rule)

Read more about Treeware at https://treeware.earth

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
