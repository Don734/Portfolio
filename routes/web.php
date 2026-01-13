<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PageController@home')->name('home');
Route::get('/projects/{category?}', 'PageController@projects')->name('projects');