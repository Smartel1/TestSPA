<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/articles', 'ArticlesController@articles');
Route::get('/article/{article}', 'ArticlesController@article');
Route::get('/article/{article}/delete', 'ArticlesController@delete');

Route::post('/article/create', 'ArticlesController@create');
Route::post('/article/{article}/edit', 'ArticlesController@edit');