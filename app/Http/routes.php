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

	// link page's routes
	Route::get('/links', 'LinkController@index');
	Route::post('/links', 'LinkController@store');
	Route::get('/links/tags', 'LinkController@getTags');
	Route::get('/links/tags/{name}', 'LinkController@getTag');
	Route::post('/links/increaseView/{link}', 'LinkController@increaseView');
	Route::post('/links/increaseVote/{link}', 'LinkController@increaseVote');
	Route::post('/links/decreaseVote/{link}', 'LinkController@decreaseVote');
	Route::post('/links/doSearch', 'LinkController@doSearch');
	Route::get('/links/doSearch', 'LinkController@doSearch');
	Route::post('/links/deleteLink/{link}', 'LinkController@deleteLink');
	Route::get('/links/{link}', 'LinkController@getComments');
	Route::post('/links/{link}/postComment', 'LinkController@postComment');
	Route::get('/links/{link}/postComment', 'LinkController@postComment');
	
	Route::post('/links/{link}/comments/{comment}/increaseVote', 'LinkController@increaseCommentVote');
	Route::post('/links/{link}/comments/{comment}/decreaseVote', 'LinkController@decreaseCommentVote');

    Route::get('/categories/{cid?}', 'CategoryController@index');
    Route::post('/categories/storeCategory', 'CategoryController@storeCategory');
    Route::get('/categories/destroyCategory/{cid?}', 'CategoryController@destroyCategory');
    Route::get('/categories/editCategory/{cid?}', 'CategoryController@editCategory');
    Route::post('/categories/editCategory/{cid?}', 'CategoryController@editCategory');
    Route::post('/categories/storeNote/{cid?}', 'CategoryController@storeNote');
    Route::get('/categories/editNote/{id}', 'CategoryController@editNote');
    Route::post('/categories/editNote/{id}', 'CategoryController@editNote');
    Route::get('/categories/destroyNote/{id}', 'CategoryController@destroyNote');

    //User processing Routes...
    Route::get('/update-profile', 'UserController@updateProfile');
    Route::post('/profile', 'UserController@updateProfile');
    Route::post('/password', 'UserController@changePassword');
    Route::post('/change-avatar', 'UserController@changeAvatar');
    Route::post('/add-avatar', 'UserController@addAvatar');
    Route::post('/upload-file', 'FileUploadController@doUploadSingle');
    Route::get('/open-modal-profile', function() {
        return view('users.modal_profile');
    });

	// Authentication Routes...
	Route::auth();


});
