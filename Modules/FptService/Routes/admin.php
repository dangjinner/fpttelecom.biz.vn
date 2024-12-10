<?php

use Illuminate\Support\Facades\Route;

Route::get('fpt-services', [
    'as' => 'admin.fpt_services.index',
    'uses' => 'FptServiceController@index',
    'middleware' => 'can:admin.fpt_services.index',
]);

Route::get('fpt-services/create', [
    'as' => 'admin.fpt_services.create',
    'uses' => 'FptServiceController@create',
    'middleware' => 'can:admin.fpt_services.create',
]);

Route::post('fpt-services', [
    'as' => 'admin.fpt_services.store',
    'uses' => 'FptServiceController@store',
    'middleware' => 'can:admin.fpt_services.create',
]);

Route::get('fpt-services/{id}/edit', [
    'as' => 'admin.fpt_services.edit',
    'uses' => 'FptServiceController@edit',
    'middleware' => 'can:admin.fpt_services.edit',
]);

Route::put('fpt-services/{id}', [
    'as' => 'admin.fpt_services.update',
    'uses' => 'FptServiceController@update',
    'middleware' => 'can:admin.fpt_services.edit',
]);

Route::delete('fpt-services/{ids?}', [
    'as' => 'admin.fpt_services.destroy',
    'uses' => 'FptServiceController@destroy',
    'middleware' => 'can:admin.fpt_services.destroy',
]);

Route::get('fpt-categories/tree', [
    'as' => 'admin.fpt_categories.tree',
    'uses' => 'FptCategoryTreeController@index',
    'middleware' => 'can:admin.fpt_services.index',
]);

Route::put('fpt-categories/tree', [
    'as' => 'admin.fpt_categories.tree.update',
    'uses' => 'FptCategoryTreeController@update',
    'middleware' => 'can:admin.fpt_services.edit',
]);

Route::get('fpt-categories', [
    'as' => 'admin.fpt_categories.index',
    'uses' => 'FptCategoryController@index',
    'middleware' => 'can:admin.fpt_categories.index',
]);

Route::get('fpt-categories/create', [
    'as' => 'admin.fpt_categories.create',
    'uses' => 'FptCategoryController@create',
    'middleware' => 'can:admin.fpt_categories.create',
]);

Route::post('fpt-categories', [
    'as' => 'admin.fpt_categories.store',
    'uses' => 'FptCategoryController@store',
    'middleware' => 'can:admin.fpt_categories.create',
]);

Route::get('fpt-categories/{id}', [
    'as' => 'admin.fpt_categories.show',
    'uses' => 'FptCategoryController@show',
    'middleware' => 'can:admin.fpt_categories.edit',
]);

Route::put('fpt-categories/{id}', [
    'as' => 'admin.fpt_categories.update',
    'uses' => 'FptCategoryController@update',
    'middleware' => 'can:admin.fpt_categories.edit',
]);

Route::delete('fpt-categories/{ids?}', [
    'as' => 'admin.fpt_categories.destroy',
    'uses' => 'FptCategoryController@destroy',
    'middleware' => 'can:admin.fpt_categories.destroy',
]);

// append


