# SitemapMaker

SitemapMaker is a PHP library for generating XML sitemaps. It provides an easy way to create, manage, and export sitemaps following the standard protocol.

## Features
- Create XML sitemaps dynamically
- Set change frequency, priority, and last modification date
- Save the sitemap to a file
- Stream the sitemap as an XML response
- Support for setting a specific timezone for `lastmod`

## Installation
### Install via Composer
```
composer require flores/sitemap-maker
```

### Manual Installation
Simply include the `Sitemap.php` and `URL.php` classes in your project.

## Usage

```php
use Flores\SitemapMaker\Sitemap;
use Flores\SitemapMaker\URL;

// Create a new sitemap with a specific timezone
$sitemap = new Sitemap("America/New_York");

// Add URLs
$url1 = new URL("https://example.com");
$url1->setChangefreq(URL::$CHANGEFREQ_DAILY);
$url1->setPriority(URL::$PRIORITY_MAX);
$url1->setLastMod(date('Y-m-d'));
$sitemap->add($url1);

$url2 = new URL("https://example.com/about");
$sitemap->add($url2);

// Save the sitemap to a file
$sitemap->save("sitemap.xml");

// Get the sitemap as a string
$xmlString = $sitemap->get();

// Stream the sitemap as an XML response
$sitemap->stream();
```

## Timezone Support
The `Sitemap` class allows you to specify a timezone when creating the object. By default, it uses `Africa/Maputo`. This ensures that `lastmod` timestamps are correctly formatted according to the specified timezone.

Example:

```php
$sitemap = new Sitemap("Europe/London");
```

This will ensure that all `lastmod` values are converted to `Europe/London` timezone before being added to the XML.

## License
This project is open-source and available under the MIT License.

## Author
Nelson Flores (<nelson.flores@live.com>)

