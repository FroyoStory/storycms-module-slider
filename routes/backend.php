<?php

Route::get('/', 'HomeController@index');

Route::get('auth', 'Auth\LoginController@index');
Route::post('auth', 'Auth\LoginController@store');
Route::get('auth/forgot', 'Auth\ForgotController@index');
Route::post('auth/forgot', 'Auth\ForgotController@store');


Route::group(['prefix' => 'cms/elements'], function() {
    Route::get('pages', 'PostController@index');
    Route::get('pages/add', 'PostController@create');
});

