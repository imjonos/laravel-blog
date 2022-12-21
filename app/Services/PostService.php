<?php

namespace App\Services;

use Nos\CRUD\Services\BaseService;
use App\Models\Post;
use App\Interfaces\Repositories\PostRepositoryInterface;

/**
 * @method PostRepositoryInterface getRepository()
 * @method Post create(array $data)
 * @method Post updateOrCreate(array $attributes, array $data)
 * @method Post find(int $modelId)
 */
final class PostService extends BaseService
{
    protected string $repositoryClass = PostRepositoryInterface::class;
}
