<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PageController@home')->name('home');
Route::get('/portfolio/{category?}', 'PageController@getPortfolioByCategory')->name('portfolio');