<?php

namespace App\Repositories;

use App\Interfaces\Repositories\PostRepositoryInterface;
use App\Models\Post;
use Nos\CRUD\Repositories\BaseRepository;

/**
 * @method Post find(int $id)
 * @method Post create(array $data)
 */
final class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    protected string $class = Post::class;

    public function getBySlug(string $slug): Post
    {
        return $this->query()->ofSlug($slug)->publish()->firstOrFail();
    }
}
