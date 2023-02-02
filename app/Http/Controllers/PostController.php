<?php

namespace App\Http\Controllers;

use App\Http\Requests\Site\Post\AddEmojiReactionRequest;
use App\Http\Requests\Site\Post\IndexRequest;
use App\Http\Requests\Site\Post\ShowRequest;
use App\Models\Post;
use App\Services\PostService;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Nos\EmojiReaction\Services\EmojiService;
use Nos\EmojiReaction\Services\ReactionService;
use Nos\EmojiReaction\Services\ReactionStatisticService;

final class PostController extends Controller
{

    private PostService $postService;
    private ReactionService $reactionService;
    private ReactionStatisticService $reactionStatisticService;
    private EmojiService $emojiService;

    public function __construct(
        PostService $postService,
        ReactionService $reactionService,
        EmojiService $emojiService,
        ReactionStatisticService $reactionStatisticService
    ) {
        $this->postService = $postService;
        $this->reactionService = $reactionService;
        $this->emojiService = $emojiService;
        $this->reactionStatisticService = $reactionStatisticService;
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
            'posts' => $posts,
            'emojis' => $this->emojiService->all()
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
            'post' => $post,
            'emojis' => $this->emojiService->all()
        ]);
    }

    public function getEmojiReactionStatistic(Post $post): JsonResponse
    {
        return response()->json($this->reactionStatisticService->getByModel($post));
    }

    /**
     * @throws Exception
     */
    public function addEmojiReaction(AddEmojiReactionRequest $request, Post $post): JsonResponse
    {
        $emoji = $this->emojiService->find($request->get('emoji_id'));
        abort_if(!$emoji, 400);

        DB::transaction(function () use ($post, $request, $emoji) {
            $this->reactionService->addReaction($post, $emoji);
        });

        return response()->json();
    }
}
