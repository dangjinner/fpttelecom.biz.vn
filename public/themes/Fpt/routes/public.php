<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/tin-tuc', 'HomeController@fptNews')->name('fpt.news');
Route::get('/tin-tuc/{slug}', 'HomeController@fptNewsCategory')->name('fpt.news.category');
Route::get('/{slug}', 'HomeController@fptCategory')->name('fpt.services.category');


