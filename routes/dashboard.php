<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PageController@dashboard');
Route::get('/profile', 'PageController@profile')->name('profile');
Route::get('/settings', 'PageController@settings')->name('settings');

Route::resource('banners', 'BannerController');
Route::resource('posts', 'PostController');
Route::resource('projects', 'ProjectController');
Route::resource('dictionary', 'WordController')->parameters(['dictionary' => 'word']);
Route::resource('users', 'UserController');