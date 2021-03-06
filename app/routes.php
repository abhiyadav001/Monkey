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

Route::post('/verify-passcode', 'UserController@verifyPasscode');

Route::post('/signup-mobile', 'UserController@signUpMobile');

Route::get('/search', 'SearchController@index');

Route::get('/locations', 'SearchController@getLocations');

Route::get('/app-settings', 'SearchController@getAppSettings');

Route::resource('orders', 'OrderController');
