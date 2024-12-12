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

Route::get('fpt-service-customers', [
    'as' => 'admin.fpt_service_customers.index',
    'uses' => 'FptServiceCustomerController@index',
    'middleware' => 'can:admin.fpt_service_customers.index',
]);

Route::get('fpt-service-customers/create', [
    'as' => 'admin.fpt_service_customers.create',
    'uses' => 'FptServiceCustomerController@create',
    'middleware' => 'can:admin.fpt_service_customers.create',
]);

Route::post('fpt-service-customers', [
    'as' => 'admin.fpt_service_customers.store',
    'uses' => 'FptServiceCustomerController@store',
    'middleware' => 'can:admin.fpt_service_customers.create',
]);

Route::get('fpt-service-customers/{id}/edit', [
    'as' => 'admin.fpt_service_customers.edit',
    'uses' => 'FptServiceCustomerController@edit',
    'middleware' => 'can:admin.fpt_service_customers.edit',
]);

Route::put('fpt-service-customers/{id}', [
    'as' => 'admin.fpt_service_customers.update',
    'uses' => 'FptServiceCustomerController@update',
    'middleware' => 'can:admin.fpt_service_customers.edit',
]);

Route::delete('fpt-service-customers/{ids?}', [
    'as' => 'admin.fpt_service_customers.destroy',
    'uses' => 'FptServiceCustomerController@destroy',
    'middleware' => 'can:admin.fpt_service_customers.destroy',
]);

// append



