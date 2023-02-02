<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\PostService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Nos\EmojiReaction\Services\EmojiService;

final class CategoryController extends Controller
{

    private CategoryService $categoryService;
    private PostService $postService;
    private EmojiService $emojiService;

    public function __construct(CategoryService $categoryService, EmojiService $emojiService, PostService $postService)
    {
        $this->categoryService = $categoryService;
        $this->postService = $postService;
        $this->emojiService = $emojiService;
    }

    /**
     * Show category
     *
     * @param string $slug
     * @return Factory|View
     * @throws BindingResolutionException
     */
    public function show(string $slug): Factory|View
    {
        $category = $this->categoryService->getBySlug($slug);
        $posts = $this->postService->search([
            'category_id' => $category->id,
            'publish' => true
        ]);

        return view('site.categories.show', [
            'posts' => $posts,
            'category' => $category,
            'emojis' => $this->emojiService->all()
        ]);
    }
}
