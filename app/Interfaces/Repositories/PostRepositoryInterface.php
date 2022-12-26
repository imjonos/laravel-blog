<?php

namespace App\Interfaces\Repositories;

use App\Models\Post;
use Nos\BaseRepository\Interfaces\EloquentRepositoryInterface;

interface PostRepositoryInterface extends EloquentRepositoryInterface
{
    public function getBySlug(string $slug): Post;
}
