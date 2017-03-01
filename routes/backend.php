<?php

Route::get('auth', 'Auth\LoginController@showLoginForm');
Route::post('auth', 'Auth\LoginController@login');
Route::get('auth/forgot', 'Auth\ForgotController@index');
Route::post('auth/forgot', 'Auth\ForgotController@store');


Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'HomeController@index');

    Route::group(['prefix' => 'cms/elements'], function() {
        Route::get('pages', 'PostController@index');
        Route::get('pages/add', 'PostController@create');
        Route::post('pages', 'PostController@store');

        Route::get('category', 'CategoryController@index');
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
});


