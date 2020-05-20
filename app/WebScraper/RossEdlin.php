<?php

namespace App\WebScraper;

/**
 * Created by PhpStorm.
 *
 * @author Ross Edlin <contact@rossedlin.com>
 *
 * Date: 11/09/2017
 * Time: 12:05
 */
class RossEdlin extends AbstractWebScraper
{
    //https://www.google.co.uk/search?q=Ross+Edlin

    /**
     * @param string $baseUrl
     * @param array  $args
     *
     * @return array
     * @throws \Exception
     */
    public function scrape($baseUrl, array $args = [])
    {
        if ( ! $this->isBaseUrlValid($baseUrl)) {
            throw new \Exception('Base URL is not Valid: ' . $baseUrl);
        }

        /**
         * Args
         */
        $subUrl = \Edlin\Core\Request::getFromArray($args, 'subUrl', '/');

        /**
         *
         */
        $return        = [];
        $html          = $this->getHtmlFromUrl($baseUrl, $subUrl);
        $searchResults = $this->filterHtmlArray($html, '#news-section article');

        /**
         * Filter each search result
         */
        foreach ($searchResults as $searchResult) {
            $return[] = [
                'title'       => $this->extractTitle($searchResult),
                'img'         => $this->extractImg($searchResult),
                'href'        => $this->extractHref($searchResult),
                'description' => $this->extractDescription($searchResult),
            ];
        }

        return $return;
    }

    /**
     * @param $baseUrl
     *
     * @return bool
     */
    private function isBaseUrlValid($baseUrl)
    {
        if ($baseUrl === 'https://www.rossedlin.com/') {
            return true;
        }

        return false;
    }

    /**
     * @param $html
     *
     * @return string
     */
    private function extractTitle($html)
    {
        try {
            return trim(strip_tags($this->filterHtmlSingle($html, 'h2 a')));
        } catch (\Exception $e) {
            return "";
        }
    }

    /**
     * @param $html
     *
     * @return string
     */
    private function extractImg($html)
    {
        try {
            return trim(strip_tags($this->filterSrc($html, 'img')));
        } catch (\Exception $e) {
            return "";
        }
    }

    /**
     * @param $html
     *
     * @return string
     */
    private function extractHref($html)
    {
        try {
            return trim(strip_tags($this->filterHref($html, 'h2 a')));
        } catch (\Exception $e) {
            return "";
        }
    }

    /**
     * @param $html
     *
     * @return string
     */
    private function extractDescription($html)
    {
        try {
            return trim(strip_tags($this->filterHtmlSingle($html, 'p')));
        } catch (\Exception $e) {
            return "";
        }
    }

    /**
     * @param $str
     *
     * @return string
     * @throws \Exception
     */
    public static function searchify($str): string
    {
        $str = strip_tags($str);
        $str = strtolower($str);

        $str = str_replace(' ', '+', $str);
        $str = \Edlin\Core\Str::replaceMultipleWithOne($str, '+', '+');

        return $str;
    }
}