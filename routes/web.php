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


Auth::routes(['register' => false]);
Route::get('logout', 'Auth\LoginController@logout');
Route::pattern('post', '[0-9]+');
Route::pattern('slug', '[A-z0-9_-]+');
Route::get('/', 'PostController@index')->name('site.posts.index');
Route::get('/posts/{slug}', 'PostController@show')->name('site.posts.show');
Route::get('/categories/{slug}', 'CategoryController@show')->name('site.categories.show');
Route::post('/posts/{slug}/comments', 'CommentController@store')->name('site.comments.store');

Route::middleware(['web', 'auth'])->group(function () {
    Route::resource('admin/posts', 'Admin\PostController');
    Route::post('admin/posts/massdestroy', 'Admin\PostController@massDestroy')->name('posts.massdestroy');
    Route::put('admin/posts/{post}/toggleboolean', 'Admin\PostController@toggleBoolean')->name('posts.toggleboolean');
    Route::pattern('category', '[0-9]+');
    Route::resource('admin/categories', 'Admin\CategoryController');
    Route::post('admin/categories/massdestroy', 'Admin\CategoryController@massDestroy')->name('categories.massdestroy');
    Route::put('admin/categories/{category}/toggleboolean', 'Admin\CategoryController@toggleBoolean')->name('categories.toggleboolean');
    Route::pattern('comment', '[0-9]+');
    Route::resource('admin/comments', 'Admin\CommentController');
    Route::post('admin/comments/massdestroy', 'Admin\CommentController@massDestroy')->name('comments.massdestroy');
    Route::put('admin/comments/{comment}/toggleboolean', 'Admin\CommentController@toggleBoolean')->name('comments.toggleboolean');
});
