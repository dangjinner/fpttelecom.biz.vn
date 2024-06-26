<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@homeV2')->name('home');
Route::get('/product/{slug}', 'HomeController@index')->name('product.category');

// Product
// Route::get('/san-pham', 'ProductController@index')->name('product.index');
Route::get('/san-pham-mua-nhieu', 'ProductController@bestSale')->name('product.index');
Route::get('/san-pham/{slug}', 'ProductController@singleV2')->name('product.single');
Route::get('/thuong-hieu/{slug}', 'ProductController@brand')->name('product.brand');

Route::group(['prefix' => 'gio-hang', 'as' => 'cart.'], function(){
    Route::get('/', 'CartController@index')->name('index');
    Route::get('/thanh-toan', 'CartController@payment')->name('payment');
    Route::post('update-cart', 'CartController@update')->name('update');
    Route::post('/getDistrict/{id}', 'CartController@getDistrict')->name('getDistrict');

    Route::post('/thanh-toan', 'CartController@postCheckout')->name('postCheckout');
});
Route::get('/prods/search-ajax', 'ProductController@searchAjax')->name('product.search.ajax');

Route::get('/sitemap.xml', 'HomeController@generateSitemap')->name('sitemap.xml');

Route::get('/ajax/categories/{slug}', 'ProductController@ajaxCategory')->name('product.ajaxCategory');
Route::get('/{slug}', 'ProductController@categoryV2')->name('product.category');

Route::post('/san-pham/danh-gia', 'ProductController@postComment')->name('product.postComment');


// Route::get('/product/{slug}', 'HomeController@index')->name('product.category');


// Blog
Route::get('/blog', 'PostController@index')->name('blog.index'); 
//Route::get('/blog/{slug}', 'PostController@category')->name('post.category');
//Route::get('/blog/{slug}', 'PostController@single')->name('post.single');

