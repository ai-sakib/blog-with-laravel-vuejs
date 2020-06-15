<?php

use Illuminate\Support\Facades\Route;

Route::get('reboot', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    file_put_contents(storage_path('logs/laravel.log'),'');
    Artisan::call('key:generate');
    Artisan::call('config:cache');
    return '<center><h1>System Rebooted!</h1></center>';
});

Route::get('/', 'FrontEndController@index');
//Route::get('/{anypath}','FrontEndController@index')->where('path','.*');
Route::get('/blogpost', 'FrontEndController@getBlogPosts');
Route::get('/get-individual-post/{data}', 'FrontEndController@getIndividualPost');
Route::get('/all-categories', 'FrontEndController@getAllCategories');
Route::get('/latest-posts', 'FrontEndController@getLatestPosts');
Route::get('/get-all-posts/{category_id}', 'FrontEndController@getPostsByCategory');
Route::get('/search', 'FrontEndController@searchPosts');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
	Route::get('/dashboard','HomeController@index');
	//Route::get('/{anypath}','HomeController@index')->where('path','([A-z\d-\/_.]+)?');
	//Route::get('/posts', 'PostController@index');

	Route::post('/add-category', 'CategoryController@store');
	Route::get('/get-category', 'CategoryController@getCategory');
	Route::get('/category/{id}', 'CategoryController@deleteCategory');
	Route::get('category/{id}/edit', 'CategoryController@edit');
	Route::post('category/{id}/update', 'CategoryController@update');

	Route::post('/add-post', 'PostController@store');
	Route::get('/get-post', 'PostController@getPost');
	Route::get('/post/{id}', 'PostController@deletePost');
	Route::get('post/{id}/edit', 'PostController@edit');
	Route::post('post/{id}/update', 'PostController@update');
});