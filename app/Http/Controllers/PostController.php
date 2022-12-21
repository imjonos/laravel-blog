<?php

namespace App\Http\Controllers;


use App\Http\Requests\Site\Post\IndexRequest;
use App\Http\Requests\Site\Post\ShowRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

final class PostController extends Controller
{
    /**
     * Show the list of the posts
     *
     * @param IndexRequest $request
     * @return Renderable
     */
    public function index(IndexRequest $request): Renderable
    {
        $search = $request->get('search', '');
        $posts = Post::publish()->ofName($search)->orWhere('detail_text', 'like', "%$search%")->orderBy(
            'id',
            'DESC'
        )->paginate(10);
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
     * @return Factory|View
     */
    public function show(ShowRequest $request, string $slug): Factory|View
    {
        $post = Post::ofSlug($slug)->publish()->firstOrFail();
        $categories = Category::all();

        return view('site.posts.show', [
            'post' => $post,
            'categories' => $categories
        ]);
    }
}
