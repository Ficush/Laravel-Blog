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

Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);
Route::get('/home', ['as' => 'home', 'uses' => 'IndexController@home']);
Route::get('/user/{id}', ['as' => 'user', 'uses' => 'IndexController@user']);
Route::get('/category/{id}', ['as' => 'category', 'uses' => 'IndexController@category']);
Route::get('/rss', ['as' => 'rss', 'uses' => 'IndexController@rss']);
Route::get('/search', ['as' => 'search', 'uses' => 'IndexController@search']);
Route::get('/link', ['as' => 'link', 'uses' => 'IndexController@link']);
Route::get('/archive', ['as' => 'archive', 'uses' => 'IndexController@archive']);
Route::get('/page/{name}', ['as' => 'page', 'uses' => 'IndexController@page']);


// Article
Route::resource('view', 'ArticleController');

// Auth
Route::controllers(['auth' => 'Auth\AuthController']);

// Install
Route::get('/install', ['as' => 'install', 'uses' => 'Install\InstallController@index']);
Route::post('/install', ['as' => 'install-post', 'uses' => 'Install\InstallController@install']);

// Admin
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function()
{
    Route::get('/', ['as' => 'admin', 'uses' => 'AdminController@index']);
    Route::resource('/category', 'CategoryController');
    Route::resource('/link', 'LinkController');
    Route::resource('/system', 'SystemController');
    Route::resource('/user', 'UserController');
    Route::resource('/article', 'ArticleController');
});
