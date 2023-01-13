<?php

namespace App\Http\Controllers;


use App\Http\Requests\Site\Post\IndexRequest;
use App\Http\Requests\Site\Post\ShowRequest;
use App\Services\PostService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

final class PostController extends Controller
{

    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Show the list of the posts
     *
     * @param IndexRequest $request
     * @return Renderable
     * @throws BindingResolutionException
     */
    public function index(IndexRequest $request): Renderable
    {
        $search = $request->get('search', '');
        $posts = $this->postService->search([
            'text' => $search,
            'publish' => true
        ]);

        return view('site.posts.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show post
     *
     * @param ShowRequest $request
     * @param string $slug
     * @return Factory|View
     * @throws BindingResolutionException
     */
    public function show(ShowRequest $request, string $slug): Factory|View
    {
        $post = $this->postService->getBySlug($slug);
        $this->postService->viewPost($post->id);

        return view('site.posts.show', [
            'post' => $post
        ]);
    }
}
