<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);
Route::pattern('post', '[0-9]+');
Route::pattern('comment', '[0-9]+');
Route::pattern('category', '[0-9]+');
Route::pattern('slug', '[A-z0-9_-]+');
Route::get('/', [\App\Http\Controllers\PostController::class, 'index'])->name('site.posts.index');
Route::get('/posts/{slug}', [\App\Http\Controllers\PostController::class, 'show'])->name('site.posts.show');
Route::get('/categories/{slug}', [\App\Http\Controllers\CategoryController::class, 'show'])->name(
    'site.categories.show'
);
Route::post('/posts/{slug}/comments', [\App\Http\Controllers\CategoryController::class, 'store'])->name(
    'site.comments.store'
);

Route::middleware(['web', 'auth'])->group(function () {
    Route::resource('admin/posts', \App\Http\Controllers\Admin\PostController::class);
    Route::post('admin/posts/massdestroy', [\App\Http\Controllers\Admin\PostController::class, 'massDestroy'])->name(
        'posts.massdestroy'
    );
    Route::post('admin/posts/{post}/publish', [\App\Http\Controllers\Admin\PostController::class, 'publish'])->name(
        'posts.publish'
    );
    Route::put('admin/posts/{post}/toggleboolean', [\App\Http\Controllers\Admin\PostController::class, 'toggleBoolean']
    )->name('posts.toggleboolean');
    Route::resource('admin/comments', \App\Http\Controllers\Admin\CommentController::class);
    Route::post('admin/comments/massdestroy', [\App\Http\Controllers\Admin\CommentController::class, 'massDestroy']
    )->name('comments.massdestroy');
    Route::put(
        'admin/comments/{comment}/toggleboolean',
        [\App\Http\Controllers\Admin\CommentController::class, 'toggleBoolean']
    )->name('comments.toggleboolean');
    Route::resource('admin/categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::post('admin/categories/massdestroy', [\App\Http\Controllers\Admin\CategoryController::class, 'massDestroy']
    )->name('categories.massdestroy');
    Route::put(
        'admin/categories/{category}/toggleboolean',
        [\App\Http\Controllers\Admin\CategoryController::class, 'toggleBoolean']
    )->name('categories.toggleboolean');
});
