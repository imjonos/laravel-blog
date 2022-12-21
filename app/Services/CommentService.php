<?php

namespace App\Services;

use Nos\CRUD\Services\BaseService;
use App\Models\Comment;
use App\Interfaces\Repositories\CommentRepositoryInterface;

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
