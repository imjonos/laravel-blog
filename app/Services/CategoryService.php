<?php

namespace App\Services;

use App\Interfaces\Repositories\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Contracts\Container\BindingResolutionException;
use Nos\CRUD\Services\BaseService;

/**
 * @method CategoryRepositoryInterface getRepository()
 * @method Category create(array $data)
 * @method Category updateOrCreate(array $attributes, array $data)
 * @method Category find(int $modelId)
 */
final class CategoryService extends BaseService
{
    protected string $repositoryClass = CategoryRepositoryInterface::class;

    /**
     * @throws BindingResolutionException
     */
    public function getBySlug(string $slug): Category
    {
        return $this->getRepository()->getBySlug($slug);
    }
}
