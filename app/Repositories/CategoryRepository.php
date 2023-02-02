<?php

namespace App\Repositories;

use App\Interfaces\Repositories\CategoryRepositoryInterface;
use App\Models\Category;
use Nos\CRUD\Repositories\BaseRepository;

/**
 * @method ?Category find(int $id)
 * @method ?Category create(array $data)
 */
final class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    protected string $class = Category::class;

    public function getBySlug(string $slug): Category
    {
        return $this->query()->ofSlug($slug)->publish()->firstOrFail();
    }
}
