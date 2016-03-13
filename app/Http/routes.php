<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
	Route::get('/', function () {
    	return view('welcome');
	});
	Route::get('/links', 'LinkController@index');
	Route::post('/links', 'LinkController@store');
    Route::get('/categories/{cid?}', 'CategoryController@index');
    Route::post('/categories/storeCategory', 'CategoryController@storeCategory');
    Route::post('/categories/storeNote/{cid?}', 'CategoryController@storeNote');
    Route::get('/categories/editNote/{id}', 'CategoryController@editNote');
    Route::post('/categories/editNote/{id}', 'CategoryController@editNote');
    Route::get('/categories/destroyNote/{id}', 'CategoryController@destroyNote');

	// Authentication Routes...
	Route::auth();
});
