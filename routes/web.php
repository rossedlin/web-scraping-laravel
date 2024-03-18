<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebScrapingController;

Route::get('/', WebScrapingController::class);
