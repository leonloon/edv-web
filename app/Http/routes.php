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

Route::get('/',
	['as' => 'getHome', 'uses' => 'MessageController@getHome']);

Route::get('/api/message',
	['as' => 'getMessage', 'uses' => 'MessageController@getMessage']);

Route::post('/api/message',
	['as' => 'postMessage', 'uses' => 'MessageController@postMessage']);
