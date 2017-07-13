<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PageController@index');
Route::get('/news', 'PageController@news');
Route::get('/scholarship', 'PageController@scholarship');

Route::get('/admin-paul', 'AdminController@index');
Route::get('/admin-paul/news', 'AdminNewsController@index');
Route::get('/admin-paul/news/add', 'AdminNewsController@add');
Route::post('/admin-paul/news/add', 'AdminNewsController@store');
Route::get('/admin-paul/news/{id}/preview', 'AdminNewsController@preview');
Route::get('/admin-paul/news/{id}/edit', 'AdminNewsController@edit');
Route::post('/admin-paul/news/{id}/edit', 'AdminNewsController@update');
Route::post('/admin-paul/news/{id}/delete', 'AdminNewsController@delete');
