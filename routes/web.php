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

Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@login');

Route::get('/register', 'RegisterController@index');
Route::post('/register', 'RegisterController@register');

Route::get('/activate/{userid}/{code}', 'ActivationController@activate');

Route::post('/logout', 'LoginController@logout');
Route::get('/logout', function (){
  return redirect('/');
});

Route::get('/news', 'UserNewsController@index');
Route::get('/news/{id}', 'UserNewsController@view');
Route::post('/news/{id}/add-comment', 'UserNewsController@addComment');
Route::get('/news/category/{id}', 'UserNewsController@newsCategoryList');
Route::get('/news/{id}/like', 'UserNewsController@like');
Route::get('/news/{id}/dislike', 'UserNewsController@dislike');

Route::get('/scholarship', 'PageController@scholarship');

Route::group(['middleware' => 'admin'], function () {
  Route::get('/admin-paul', 'AdminController@index');

  Route::get('/admin-paul/users', 'AdminUsersController@index');
  Route::get('/admin-paul/users/setting', 'AdminUserController@setting');

  Route::get('/admin-paul/news', 'AdminNewsController@index');
  Route::get('/admin-paul/news/add', 'AdminNewsController@add');
  Route::post('/admin-paul/news/add', 'AdminNewsController@store');
  Route::get('/admin-paul/news/{id}/preview', 'AdminNewsController@preview');
  Route::get('/admin-paul/news/{id}/edit', 'AdminNewsController@edit');
  Route::post('/admin-paul/news/{id}/edit', 'AdminNewsController@update');
  Route::post('/admin-paul/news/{id}/deleteimage', 'AdminNewsController@deleteFeaturedImage');
  Route::post('/admin-paul/news/{id}/delete', 'AdminNewsController@delete');
  Route::get('/admin-paul/news/category', 'AdminNewsController@category');
  Route::post('/admin-paul/news/category/show', 'AdminNewsController@category');
  Route::get('/admin-paul/news/category/{id}/list', 'AdminNewsController@showCategory');
  Route::post('/admin-paul/news/category/{id}/list', 'AdminNewsController@updateCategory');
  Route::post('/admin-paul/news/cateogry/{id}/delete', 'AdminNewsController@deleteCategory');
  Route::post('/admin-paul/news/{id}/comment', 'AdminNewsController@addComment');
  Route::post('/admin-paul/news/{news_id}/comment/{comment_id}/delete', 'AdminNewsController@deleteComment');

  Route::get('/admin-paul/scholarships', 'AdminScholarshipsController@index');
  Route::get('/admin-paul/scholarships/add', 'AdminScholarshipsController@add');
  Route::post('/admin-paul/scholarships/add', 'AdminScholarshipsController@store');
  Route::post('/admin-paul/scholarships/{id}/delete', 'AdminScholarshipsController@delete');
  Route::get('/admin-paul/scholarships/{id}/edit', 'AdminScholarshipsController@edit');
  Route::post('/admin-paul/scholarships/{id}/edit', 'AdminScholarshipsController@update');
  Route::get('/admin-paul/scholarships/{id}/preview', 'AdminScholarshipsController@preview');
  Route::post('/admin-paul/scholarships/{id}/comment', 'AdminScholarshipsController@addComment');
  Route::post('/admin-paul/scholarships/{scholarship_id}/comment/{comment_id}/delete', 'AdminScholarshipsController@deleteComment');

});
