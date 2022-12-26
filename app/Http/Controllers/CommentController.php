<?php

namespace App\Http\Controllers;

use App\Http\Requests\Site\Comment\StoreRequest;
use App\Services\PostService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;

final class CommentController extends Controller
{

    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Store comment
     *
     * @param StoreRequest $request
     * @param string $slug
     * @return RedirectResponse
     * @throws BindingResolutionException
     */
    public function store(StoreRequest $request, string $slug): RedirectResponse
    {
        $post = $this->postService->getBySlug($slug);
        $data = [];
        $data['user_name'] = $request->get('user_name');
        $data['comment'] = $request->get('comment');
        $data['publish'] = false;
        $data['post_id'] = $post->id;

        $post->comments()->create($data);

        return response()->redirectToRoute('site.posts.show', ['slug' => $post->slug])->with(
            'message',
            trans('layout.comment_added')
        );
    }
}
