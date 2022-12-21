<?php

namespace App\Http\Controllers;

use App\Http\Requests\Site\Comment\StoreRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;

final class CommentController extends Controller
{
    /**
     * Store comment
     *
     * @param StoreRequest $request
     * @param string $slug
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, string $slug): RedirectResponse
    {
        $post = Post::ofSlug($slug)->publish()->firstOrFail();
        $data = [];
        $data['user_name'] = $request->get('user_name');
        $data['comment'] = $request->get('comment');
        $data['publish'] = false;
        $data['post_id'] = $post->id;

        $post->comments()->create($data);

        return response()->redirectToRoute('site.posts.show', ['slug' => $post->slug]);
    }
}
