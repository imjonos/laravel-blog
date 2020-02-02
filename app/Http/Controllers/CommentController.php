<?php

namespace App\Http\Controllers;

use App\Http\Requests\Site\Comment\StoreRequest;
use App\Post;

class CommentController extends Controller
{
    /**
     * Store comment
     *
     * @param StoreRequest $request
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request, string $slug)
    {
        $post = Post::ofSlug($slug)->publish()->firstOrFail();
        $data = [];
        $data['user_name'] = $request->get('user_name');
        $data['comment'] = $request->get('comment');
        $data['post_id'] = $post->id;

        $post->comments()->create($data);
        return response()->redirectToRoute('site.posts.show', ['slug' => $post->slug]);
    }
}
