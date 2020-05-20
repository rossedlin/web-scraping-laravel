<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 14/05/2020
 * Time: 17:35
 *
 * Class Stripe
 *
 * @package App\Http\Controllers
 */
class WebScrapingController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        return view('index', [
            'cssVersion' => md5(file_get_contents(__DIR__ . '/../../../public/css/app.css')),
            'jsVersion'  => md5(file_get_contents(__DIR__ . '/../../../public/js/app.js')),
        ]);
    }

    /**
     * @throws \Exception
     */
    public function apiGoogleSearch()
    {
        $searchValue = Core\Request::post('search_value', 'Ross+Edlin');
        $subUrl      = '/search?q=' . WebScraper\Google\Search::searchify($searchValue);

        $scraper            = new WebScraper\Google\Search();
        $this->data['url']  = 'https://www.google.co.uk' . $subUrl;
        $this->data['rows'] = $scraper->scrap('https://www.google.co.uk/', [
            'subUrl' => $subUrl,
        ]);

        return view('portfolio/web-scraping/google/search/table', $this->data);
    }
}