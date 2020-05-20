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
    const GOOGLE_URL = 'https://www.google.co.uk/search?q=';

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        return view('index', [
            'googleUrl'  => self::GOOGLE_URL,
            'cssVersion' => md5(file_get_contents(__DIR__ . '/../../../public/css/app.css')),
            'jsVersion'  => md5(file_get_contents(__DIR__ . '/../../../public/js/app.js')),
        ]);
    }

    /**
     * @throws \Exception
     */
    public function apiGoogleSearch(Request $request)
    {
        $searchValue = \App\WebScraper\GoogleSearch::searchify($request->post('search_value', 'Ross+Edlin'));
        $subUrl      = '/search?q=' . $searchValue;
        $fullUrl     = self::GOOGLE_URL . $searchValue;
        pre($searchValue);
        pre($subUrl);
        pre($fullUrl);
        exit;

//
//        $scraper            = new WebScraper\Google\Search();
//        $this->data['url']  = 'https://www.google.co.uk' . $subUrl;
//        $this->data['rows'] = $scraper->scrap('https://www.google.co.uk/', [
//            'subUrl' => $subUrl,
//        ]);

        return view('table', [
            'obj' => new \stdClass(),
        ]);
    }
}