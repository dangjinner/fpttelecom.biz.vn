<?php

use Illuminate\Support\Facades\Route;

//Route::get('cart', 'CartController@index')->name('cart.index');
Route::any('cart/items', 'CartItemController@store')->name('cart.items.store');
Route::post('cart/jax/items', 'CartItemController@ajaxStore')->name('cart.items.store.ajax');
Route::put('cart/items/{cartItemId}', 'CartItemController@update')->name('cart.items.update');
Route::put('cart/items/add-service/{cartItemId}', 'CartItemController@addService')->name('cart.items.addService');
Route::put('cart/items/remove-service/{cartItemId}', 'CartItemController@removeService')->name('cart.items.removeService');
Route::put('cart/items/update-support/{cartItemId}', 'CartItemController@updateSupport')->name('cart.items.updateSupport');
Route::delete('cart/items/{cartItemId}', 'CartItemController@destroy')->name('cart.items.destroy');

Route::post('cart/clear', 'CartClearController@store')->name('cart.clear.store');

Route::post('cart/shipping-method', 'CartShippingMethodController@store')->name('cart.shipping_method.store');

Route::get('cart/cross-sell-products', 'CartCrossSellProductsController@index')->name('cart.cross_sell_products.index');
