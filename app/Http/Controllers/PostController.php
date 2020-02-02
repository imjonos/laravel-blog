<?php

namespace App\Http\Controllers;


use App\Category;
use App\Http\Requests\Site\Post\IndexRequest;
use App\Http\Requests\Site\Post\ShowRequest;
use App\Post;

class PostController extends Controller
{
    /**
     * Show the list of the posts
     *
     * @param IndexRequest $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(IndexRequest $request)
    {
        $search = $request->get('search', '');
        $posts = Post::publish()->ofName($search)->orWhere('detail_text', 'like', "%$search%")->paginate(10);
        $categories = Category::all();
        return view('site.posts.index', [
            "posts" => $posts,
            "categories" => $categories
        ]);
    }


    /**
     * Show post
     *
     * @param ShowRequest $request
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(ShowRequest $request, string $slug)
    {
        $post = Post::ofSlug($slug)->publish()->firstOrFail();
        $categories = Category::all();
        return view('site.posts.show', [
            'post' => $post,
            'categories' => $categories
        ]);
    }
}
