<?php

namespace App\Services;

use App\Interfaces\Repositories\CommentRepositoryInterface;
use App\Models\Comment;
use Nos\CRUD\Services\BaseService;

/**
 * @method CommentRepositoryInterface getRepository()
 * @method Comment create(array $data)
 * @method Comment updateOrCreate(array $attributes, array $data)
 * @method Comment find(int $modelId)
 */
final class CommentService extends BaseService
{
    protected string $repositoryClass = CommentRepositoryInterface::class;
}
