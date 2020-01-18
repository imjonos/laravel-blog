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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');
Route::pattern('post', '[0-9]+');
Route::get('/posts', 'PostController@index')->name('site.posts.index');
Route::get('/posts/{post}', 'PostController@show')->name('site.posts.show');
Route::resource('admin/posts', 'Admin\PostController');
Route::post('admin/posts/massdestroy', 'Admin\PostController@massDestroy')->name('posts.massdestroy');
Route::put('admin/posts/{post}/toggleboolean', 'Admin\PostController@toggleBoolean')->name('posts.toggleboolean');
