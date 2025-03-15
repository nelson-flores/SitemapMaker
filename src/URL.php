<?php

namespace Flores\SitemapMaker;

/**
 * The URL class represents a URL within a sitemap.
 * It allows setting and retrieving attributes such as change frequency, priority, and last modification date.
 *
 * @author Nelson Flores <nelson.flores@live.com>
 */
class URL
{
    /** @var string The URL of the page */
    private $loc;
    
    /** @var string The frequency of URL changes */
    private $changefreq;
    
    /** @var string The priority of the URL */
    private $priority;
    
    /** @var string The last modification date */
    private $lastmod;

    // Constants for allowed change frequency values
    public static $CHANGEFREQ_ALWAYS = "always";
    public static $CHANGEFREQ_HOURLY = "hourly";
    public static $CHANGEFREQ_DAILY = "daily";
    public static $CHANGEFREQ_WEEKLY = "weekly";
    public static $CHANGEFREQ_MOUTHLY = "monthly";
    public static $CHANGEFREQ_YEARLY = "yearly";
    public static $CHANGEFREQ_NEVER = "never";

    // Constants for allowed priority values
    public static $PRIORITY_MAX = "1.0";
    public static $PRIORITY_09 = "0.9";
    public static $PRIORITY_08 = "0.8";
    public static $PRIORITY_07 = "0.7";
    public static $PRIORITY_06 = "0.6";
    public static $PRIORITY_05 = "0.5";
    public static $PRIORITY_04 = "0.4";
    public static $PRIORITY_03 = "0.3";
    public static $PRIORITY_02 = "0.2";
    public static $PRIORITY_01 = "0.1";
    public static $PRIORITY_00 = "0.0";

    /**
     * Class constructor.
     *
     * @param string $loc A valid URL
     * @throws \Exception If the URL is invalid
     */
    public function __construct($loc)
    {
        $this->checkUrl($loc);
        $this->loc = $loc;
    }

    /**
     * Validates the provided URL.
     *
     * @param string $url The URL to be validated
     * @throws \Exception If the URL is invalid
     * @return self
     */
    private function checkUrl($url)
    {
        if (!preg_match("~^[a-zA-Z]+://~", $url)) {
            throw new \Exception("Invalid URL");
        }
        return $this;
    }

    /**
     * Gets the change frequency of the URL.
     *
     * @return string|null
     */
    public function getChangefreq()
    {
        return $this->changefreq;
    }

    /**
     * Sets the change frequency of the URL.
     *
     * @param string $changefreq
     */
    public function setChangefreq($changefreq)
    {
        $this->changefreq = $changefreq;
    }

    /**
     * Sets the priority of the URL.
     *
     * @param string $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * Gets the priority of the URL.
     *
     * @return string|null
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Sets the URL.
     *
     * @param string $loc
     */
    public function setLoc($loc)
    {
        $this->loc = $loc;
    }

    /**
     * Gets the URL.
     *
     * @return string
     */
    public function getLoc()
    {
        return $this->loc;
    }

    /**
     * Sets the last modification date.
     *
     * @param string $datetime
     */
    public function setLastMod($datetime)
    {
        $this->lastmod = $datetime;
    }

    /**
     * Gets the last modification date.
     *
     * @return string|null
     */
    public function getLastMod()
    {
        return $this->lastmod;
    }
}
