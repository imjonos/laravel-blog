<?php

namespace App\Services;

use App\Interfaces\Repositories\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Contracts\Container\BindingResolutionException;
use Nos\CRUD\Services\BaseService;

/**
 * @method PostRepositoryInterface getRepository()
 * @method Post create(array $data)
 * @method Post updateOrCreate(array $attributes, array $data)
 * @method Post find(int $modelId)
 */
final class PostService extends BaseService
{
    protected string $repositoryClass = PostRepositoryInterface::class;

    /**
     * @throws BindingResolutionException
     */
    public function getBySlug(string $slug): Post
    {
        return $this->getRepository()->getBySlug($slug);
    }
}
