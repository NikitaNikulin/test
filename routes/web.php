<?php

// Authentication routes...
Route::get('social/auth', 'Auth\AuthController@getSocialAuth');
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin')->name('auth.postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout')->name('auth.getLogout');
Route::get('auth/activate', 'Auth\AuthController@activate')->name('auth.activate');
Route::get('auth/send_activation/{user_id}', 'Auth\AuthController@sendActivation')->name('auth.send_activation')->where('user_id', '[0-9]+');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister')->name('auth.postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail')->name('password.postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset')->name('password.reset');

// Raw routes
if(!Request::is('*_debugbar*') && !Request::is('*admin_panel*'))
	Route::get(Request::path(), 'PagesController@test')->name('test');

//HOME
Route::get('/', 'PagesController@getHome')->name('home');

// Search
Route::get('searched', 'PagesController@getSearched')->name('searched');

//ImageCache
Route::get('fitImage', 'BaseController@fitImage')->name('fitImage');
Route::get('resizeImage', 'BaseController@resizeImage')->name('resizeImage');

Route::group(['prefix' => 'ajax'], function () {
	Route::post('modal/getModalContent', 'AjaxController@getModalContent')->name('ajax.getModalContent');
	Route::post('uploadFile', 'AjaxController@uploadFile')->name('uploadFile');
	Route::post('uploadImage', 'AjaxController@uploadImage')->name('uploadImage');
});

//--------------------------------------------------------------------------------------------------------------

// Profiles
Route::group(['middleware' => 'auth'], function () {
	Route::get('profiles/show', 'PagesController@showProfile')->name('profiles.show');
	Route::post('profiles/{id}/update', 'PagesController@updateProfile')->name('profiles.update')->where('id', '[0-9]+');
});

// Pages
Route::get('pages/{view}', 'PagesController@showPage')->name('pages.show');