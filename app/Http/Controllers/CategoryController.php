<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

final class CategoryController extends Controller
{
    /**
     * Show category
     *
     * @param string $slug
     * @return Factory|View
     */
    public function show(string $slug): Factory|View
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
