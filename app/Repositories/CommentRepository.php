<?php

namespace App\Repositories;

use App\Interfaces\Repositories\CommentRepositoryInterface;
use App\Models\Comment;
use Nos\CRUD\Repositories\BaseRepository;

/**
 * @method Comment find(int $id)
 * @method Comment create(array $data)
 */
final class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    protected string $class = Comment::class;
}
