<?php

namespace App\Interfaces\Repositories;

use App\Models\Category;
use Nos\BaseRepository\Interfaces\EloquentRepositoryInterface;

interface CategoryRepositoryInterface extends EloquentRepositoryInterface
{
    public function getBySlug(string $slug): Category;
}
