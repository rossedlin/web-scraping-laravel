<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 20/05/2020
 * Time: 13:26
 *
 * Class WebScrapingController
 */
class WebScrapingController extends Controller
{
    /**
     * @return mixed
     */
    public function __invoke(): mixed
    {
        return view('index', [
            'scrapeUrl' => $this->getBaseUrl() . $this->getSubUrl(),
        ]);
    }

    /**
     * @param Request $request
     *
     * @return Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function apiScrape(Request $request)
    {
        $scraper = new \App\WebScraper\CodeWithRoss();
        $scrape  = $scraper->scrape($this->getBaseUrl(), [
            'subUrl' => $this->getSubUrl(),
        ]);

        return view('table', [
            'url'  => $this->getFullUrl(),
            'rows' => $scrape,
        ]);
    }

    /**
     * @return string
     */
    private function getBaseUrl(): string
    {
        return 'https://www.codewithross.com/';
    }

    /**
     * @return string
     */
    private function getSubUrl(): string
    {
        return '';
    }

    /**
     * @return string
     */
    private function getFullUrl(): string
    {
        return $this->getBaseUrl() . $this->getSubUrl();
    }
}
