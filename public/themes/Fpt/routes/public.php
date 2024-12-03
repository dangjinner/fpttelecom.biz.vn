<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');

// Route::get('fpt/featured-categories/{categoryNumber}/products', 'FeaturedCategoryProductController@index')->name('fpt.featured_category_products.index');
// Route::get('fpt/tab-products/sections/{sectionNumber}/tabs/{tabNumber}', 'TabProductController@index')->name('fpt.tab_products.index');
// Route::get('fpt/product-grid/tabs/{tabNumber}', 'ProductGridController@index')->name('fpt.product_grid.index');
// Route::get('fpt/flash-sale-products', 'FlashSaleProductController@index')->name('fpt.flash_sale_products.index');
// Route::get('fpt/vertical-products/{columnNumber}', 'VerticalProductController@index')->name('fpt.vertical_products.index');

// Route::post('fpt/newsletter-popup', 'NewsletterPopup@store')->name('fpt.newsletter_popup.store');
// Route::delete('fpt/newsletter-popup', 'NewsletterPopup@destroy')->name('fpt.newsletter_popup.destroy');

// Route::delete('fpt/cookie-bar', 'CookieBarController@destroy')->name('fpt.cookie_bar.destroy');
