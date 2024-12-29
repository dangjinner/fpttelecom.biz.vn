<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');

Route::get('/dang-ky-thong-tin', 'HomeController@registerService')->name('fpt.register.service');
Route::post('/dang-ky-thong-tin', 'HomeController@postRegisterService')->name('fpt.register.service.post');
Route::get('/dang-ky-thong-tin/hoan-tat', 'HomeController@registerCompleted')->name('fpt.register.completed');

Route::get('/tin-tuc', 'HomeController@fptNews')->name('fpt.news');
Route::get('/tin-tuc/{slug}', 'HomeController@fptNewsCategory')->name('fpt.news.category');

Route::get('/provinces/{provinceId}/districts', 'HomeController@fptDistricts')->name('fpt.districts');
Route::get('/provinces/{provinceId}/districts/{districtId}/wards', 'HomeController@fptWards')->name('fpt.wards');

Route::prefix('gio-hang')->name('cart.')->group(function () {
    Route::get('/', 'CartController@index')->name('index');
    Route::post('/update', 'CartController@update')->name('update');
});

Route::get('/san-pham/{slug}', 'ProductController@show')->name('fpt.products.show');
Route::get('/ajax/categories/{slug}', 'ProductController@ajaxCategory')->name('fpt.products.ajaxCategory');

Route::get('/{slug}', 'HomeController@fptCategory')->name('fpt.services.category');






