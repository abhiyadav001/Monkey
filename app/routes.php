<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::post('/signin-mobile', 'UserController@signInMobile');

Route::post('/save-user', 'UserController@saveUserInfo');

Route::post('/signup-mobile', 'UserController@signUpMobile');

Route::get('/search', 'SearchController@index');

Route::get('/locations', 'SearchController@getLocations');

Route::get('/app-settings', 'SearchController@getAppSettings');

Route::resource('orders', 'OrderController');

Route::resource('reviews', 'ReviewController');

Route::post('/admin-dashboard', 'UserController@postSignin');

Route::get('/login', 'UserController@signInAdmin');

Route::resource('app-users', 'AppUserController');

Route::post('/search-passcode', 'AppUserController@searchPasscode');
Route::post('/update-status', 'AppUserController@updateStatus');

Route::get('/get-order/{id}', 'AppUserController@getOrder');
