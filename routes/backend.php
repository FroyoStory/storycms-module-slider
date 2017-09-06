<?php

Route::get('auth', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('auth', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');
Route::get('auth/forgot', 'Auth\ForgotController@index');
Route::post('auth/forgot', 'Auth\ForgotController@store');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index');
    Route::resource('category', 'CategoryController', ['only' => ['index', 'store', 'update', 'destroy']]);
    Route::resource('user', 'UserController', ['only' => ['index', 'store', 'update', 'destroy']]);
    Route::resource('role', 'RoleController', ['only' => ['index', 'store', 'update', 'destroy']]);

    // Settings
    Route::group(['prefix' => 'setting'], function() {
        Route::resource('general', 'Settings\\GeneralController', ['only' => ['index', 'store']]);
    });
});
