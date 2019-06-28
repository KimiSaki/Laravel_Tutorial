<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('/works', 'WorkController');
Route::get('/hash_tags/{id}/works', 'WorkController@showByHashTag')->name('hash_tags.works');
Route::get('/works/search/{keyword}', 'WorkController@searchByKeyword')->name('works.search');
Route::get('user/{id}/profile', 'UserProfileController@show')->name('user_profile.show');
Route::get('/works/{id}/read', 'WorkController@read')->name('works.read');

// // ルーティングレベルで認証を要求するときにはこう書けば出来ます！
Route::group(['middleware' => 'auth'], function () {
    Route::get('user/{id}/profile/edit', 'UserProfileController@edit')->name('user_profile.edit');
    Route::match(['put', 'patch'], 'user/{user}/profile', 'UserProfileController@update')->name('user_profile.update');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin')->name('auth.getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin')->name('auth.postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout')->name('auth.getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister')->name('auth.getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister')->name('auth.postRegister');
