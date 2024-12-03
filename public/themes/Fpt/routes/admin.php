<?php

use Illuminate\Support\Facades\Route;

Route::get('fpt', [
    'as' => 'admin.fpt.settings.edit',
    'uses' => 'FptController@edit',
]);

Route::put('fpt', [
    'as' => 'admin.fpt.settings.update',
    'uses' => 'FptController@update',
]);
