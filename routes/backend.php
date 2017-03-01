<?php

Route::get('/', 'HomeController@index');

Route::get('auth', 'Auth\LoginController@index');
Route::post('auth', 'Auth\LoginController@store');
Route::get('auth/forgot', 'Auth\ForgotController@index');
Route::post('auth/forgot', 'Auth\ForgotController@store');


Route::group(['prefix' => 'cms/elements'], function() {
    Route::get('pages', 'PostController@index');
    Route::get('pages/add', 'PostController@create');
    Route::post('pages', 'PostController@store');

    Route::get('category', 'CategoryController@index');
    Route::get('category/add', 'CategoryController@create');
    Route::post('category', 'CategoryController@store');
    Route::get('category/{id}', 'CategoryController@edit');
    Route::post('category/{id}', 'CategoryController@update');
    Route::delete('category/{id}', 'CategoryController@destroy');
});

Route::group(['prefix' => 'user/groups'], function() {
    Route::get('member', 'UserController@index');
    Route::get('member/add', 'UserController@create');
    Route::post('member', 'UserController@store');
    Route::get('member/{id}', 'UserController@edit');
    Route::post('member/{id}', 'UserController@update');
    Route::delete('member/{id}', 'UserController@destroy');
});

