<?php

namespace App\WebScraper;

/**
 * Created by PhpStorm.
 *
 * @author Ross Edlin <hey@codwithross.com>
 *
 * Date: 11/09/2017
 * Time: 12:05
 */
class CodeWithRoss extends AbstractWebScraper
{
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
        $searchResults = $this->filterHtmlArray($html, '#blog-posts > div > div > div');

        /**
         * Filter each search result
         */
        foreach ($searchResults as $searchResult) {

            $item = [
                'title'       => $this->extractTitle($searchResult),
                'img'         => $this->extractImg($searchResult),
                'href'        => $this->extractHref($searchResult),
                'description' => $this->extractDescription($searchResult),
            ];

            $return[] = $item;
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
        if ($baseUrl === 'https://dev.codewithross.com/') {
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
            return trim(strip_tags($this->filterHtmlSingle($html, 'h5')));
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
            return 'https://dev.codwithross.com' . trim(strip_tags($this->filterSrc($html, 'img')));
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
            return 'https://dev.codwithross.com' . trim(strip_tags($this->filterHref($html, 'a')));
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
            return trim(strip_tags($this->filterHtmlSingle($html, 'div .card-text')));
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
