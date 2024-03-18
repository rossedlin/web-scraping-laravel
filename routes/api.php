<?php

use Illuminate\Support\Facades\Route;

Route::get('/web-scraping', 'App\Http\Controllers\WebScrapingController@apiScrape');
