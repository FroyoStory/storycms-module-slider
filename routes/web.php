<?php

Route::get('auth', 'Auth\LoginController@showLoginForm');

Route::get('/', 'HomeController@index');
Route::get('search', 'SearchController@index');
Route::get('category/{category}', 'CategoryController@show');
Route::get('/{arg1}', 'PostController@show');
Route::get('/{arg1}/{arg2}', 'PostController@show');
Route::get('/{arg1}/{arg2}/{arg3}', 'PostController@show');
Route::get('/{arg1}/{arg2}/{arg3}/{arg4}', 'PostController@show');
