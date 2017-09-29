<?php

Route::get('auth', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('auth', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');
Route::get('auth/forgot', 'Auth\ForgotController@index');
Route::post('auth/forgot', 'Auth\ForgotController@store');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index');
    Route::resource('category', 'CategoryController', ['only' => ['index', 'store', 'update', 'destroy']]);
    Route::post('category/rebuild', 'CategoryController@rebuild')->name('category.rebuild');
    Route::resource('user', 'UserController', ['only' => ['index', 'store', 'update', 'destroy']]);
    Route::resource('role', 'RoleController', ['only' => ['index', 'store', 'update', 'destroy']]);
    Route::resource('menu', 'MenuController', ['only' => ['index', 'store', 'update', 'destroy']]);
    Route::resource('profile', 'ProfileController', ['only' => ['index', 'store']]);
    Route::resource('post', 'PostController');
    Route::resource('media', 'MediaController');

    Route::get('plugins', 'PluginController@index')->name('plugin.index');
    Route::post('plugins', 'PluginController@store')->name('plugin.store');
    Route::delete('plugins', 'PluginController@destroy')->name('plugin.destroy');

    // Settings
    Route::group(['prefix' => 'setting'], function() {
        Route::resource('general', 'Settings\\GeneralController', ['only' => ['index', 'store']]);
        Route::resource('media', 'Settings\\MediaController', ['only' => ['index', 'store']]);
        Route::resource('permalink', 'Settings\\PermalinkController', ['only' => ['index', 'store']]);
        Route::resource('theme', 'Settings\\ThemeController', ['only' => ['index', 'store']]);
    });
});
