<?php

namespace Flores\SitemapMaker;

use DateTime;
use DateTimeZone;
use Exception;

/**
 * The Sitemap class generates an XML sitemap following the standard protocol.
 * It manages a collection of URL objects and converts them into an XML structure.
 *
 * @author Nelson Flores <nelson.flores@live.com>
 */
class Sitemap
{
    /** @var URL[] An array of URL objects */
    private $urls = [];

    /** @var string[] An array containing the XML structure */
    private $content = [];

    /** @var string The timezone used for date formatting */
    private $timezone = "";

    /**
     * Class constructor.
     *
     * @param string $timezone The timezone used for lastmod date formatting (default: 'Africa/Maputo')
     */
    public function __construct($timezone = 'Africa/Maputo')
    {
        array_push($this->content, '<?xml version="1.0" encoding="UTF-8"?>');
        array_push($this->content, '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');
        $this->timezone = $timezone;
    }

    /**
     * Generates the XML structure for the sitemap.
     *
     * @return string The complete XML sitemap as a string
     */
    private function generate()
    {
        foreach ($this->urls as $url) {
            array_push($this->content, '<url>');
            array_push($this->content, '<loc>' . $url->getLoc() . '</loc>');

            if (!empty($url->getLastMod())) {
                array_push($this->content, '<lastmod>' . $this->handleLastmod($url->getLastMod()) . '</lastmod>');
            }
            if (!empty($url->getChangefreq())) {
                array_push($this->content, '<changefreq>' . $url->getChangefreq() . '</changefreq>');
            }
            if (!empty($url->getPriority())) {
                array_push($this->content, '<priority>' . $url->getPriority() . '</priority>');
            }
            array_push($this->content, '</url>');
        }

        array_push($this->content, '</urlset>');
        return implode('', $this->content);
    }

    /**
     * Formats the last modification date to the required XML format.
     *
     * @param string $datetime The original date string
     * @return string The formatted date in ISO 8601 format
     */
    private function handleLastmod($datetime)
    {
        $date = new DateTime($datetime, new DateTimeZone($this->timezone));
        return $date->format('c');
    }

    /**
     * Adds a URL object to the sitemap.
     *
     * @param URL $url The URL object to add
     * @return self
     */
    public function add($url)
    {
        array_push($this->urls, $url);
        return $this;
    }

    /**
     * Returns the generated XML sitemap.
     *
     * @return string The XML representation of the sitemap
     */
    public function get()
    {
        return $this->generate();
    }
    
    /**
     * Streams the sitemap as an XML response with the correct headers.
     */
    public function stream()
    {
        header("Content-Type: application/xml; charset=UTF-8");
        exit($this->generate());
    }

    /**
     * Saves the generated sitemap to a file.
     *
     * @param string $path The file path where the sitemap will be saved
     * @throws Exception If the file cannot be written
     */
    public function save($path)
    {
        if (file_put_contents($path, $this->generate()) === false) {
            throw new Exception("Failed to save the sitemap to " . $path);
        }
    }
}
