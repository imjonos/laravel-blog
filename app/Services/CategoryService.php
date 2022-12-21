<?php

namespace App\Services;

use Nos\CRUD\Services\BaseService;
use App\Models\Category;
use App\Interfaces\Repositories\CategoryRepositoryInterface;

/**
 * @method CategoryRepositoryInterface getRepository()
 * @method Category create(array $data)
 * @method Category updateOrCreate(array $attributes, array $data)
 * @method Category find(int $modelId)
 */
final class CategoryService extends BaseService
{
    protected string $repositoryClass = CategoryRepositoryInterface::class;
}
