<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth'], function() {
    Route::get('dashboard', 'PageController@dashboard')->name('dashboard');
    Route::get('profile', 'PageController@profile')->name('profile');

    Route::post('projects/{project}/set-cover/{media}', 'ProjectController@setCover')->name('projects.set_cover');
    Route::post('profile/{user}', 'UserController@profileUpdate')->name('profile.update');
    Route::post('users/{user}/update-pass', 'UserController@userUpdatePassword')->name('users.update_pass');

    Route::resource('projects', 'ProjectController');
    Route::resource('categories', 'CategoryController');
    Route::resource('technologies', 'TechnologyController');
    Route::resource('media', 'MediaController')->parameters(['media' => 'media']);
    Route::resource('users', 'UserController');

    Route::get('settings', 'SettingController@edit')->name('settings.edit');
    Route::put('settings', 'SettingController@update')->name('settings.update');
});

