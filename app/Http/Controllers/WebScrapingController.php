<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 20/05/2020
 * Time: 13:26
 *
 * Class WebScrapingControlle
 */
class WebScrapingController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        return view('index', [
            'scrapeUrl'  => $this->getBaseUrl() . $this->getSubUrl(),
            'cssVersion' => md5(file_get_contents(__DIR__ . '/../../../public/css/app.css')),
            'jsVersion'  => md5(file_get_contents(__DIR__ . '/../../../public/js/app.js')),
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function apiScrapeRossEdlin(Request $request)
    {
        $scraper = new \App\WebScraper\RossEdlin();
        $scrape  = $scraper->scrape($this->getBaseUrl(), [
            'subUrl' => $this->getSubUrl(),
        ]);

        pre($scrape);
        exit;

//        $this->data['url']  = 'https://www.google.co.uk' . $subUrl;

        return view('table', [
            'obj' => new \stdClass(),
        ]);
    }

    /**
     * @return string
     */
    private function getBaseUrl(): string
    {
        return 'https://www.rossedlin.com/';
    }

    /**
     * @return string
     */
    private function getSubUrl(): string
    {
        return 'blog/';
    }
}