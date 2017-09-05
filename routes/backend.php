<?php

Route::get('auth', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('auth', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');
Route::get('auth/forgot', 'Auth\ForgotController@index');
Route::post('auth/forgot', 'Auth\ForgotController@store');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index');
    Route::resource('category', 'CategoryController');
    Route::resource('user', 'UserController');
    Route::resource('role', 'RoleController');
});
