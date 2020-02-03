<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Show category
     *
     * @param string $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(string $slug)
    {
        $category = Category::ofSlug($slug)->publish()->firstOrFail();
        $posts = Post::publish()->ofCategoryId($category->id)->orderBy('id', 'DESC')->paginate(10);
        $categories = Category::all();
        return view('site.categories.show', [
            'posts' => $posts,
            'category' => $category,
            'categories' => $categories
        ]);
    }
}
