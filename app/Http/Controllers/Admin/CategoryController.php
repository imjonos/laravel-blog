<?php
/**
 * Eugeny Nosenko 2022
 * https://toprogram.ru
 * info@toprogram.ru
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Container\BindingResolutionException;
use App\Http\Requests\Admin\Category\{
    IndexRequest,
    CreateRequest,
    EditRequest,
    ShowRequest,
    StoreRequest,
    UpdateRequest,
    DestroyRequest,
    MassDestroyRequest,
    ToggleBooleanRequest
};
use App\Models\Category;
use App\Services\CategoryService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;


/**
 * Class CRUDController
 * @package Nos\CRUD\Http\Controllers
 */
final class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * List of records
     * @param IndexRequest $request
     * @return JsonResponse|View
     * @throws BindingResolutionException
     */
    public function index(IndexRequest $request): JsonResponse|View
    {
        $fields = [
            'id',
            'name',
            'slug',
            'publish',
            
        ];
        $with = [
            
        ];
        $limit = $request->get('per_page', 10);
        $data = $this->categoryService->search($request->all(), $fields, $with, $limit);
        $response = [
            'data' => $data,
            'selected' => [
                'id' => $request->get('id'),
                'name' => $request->get('name'),
                'slug' => $request->get('slug'),
                'publish' => $request->get('publish'),
                
            ]
        ];
        if ($request->ajax()) {
            return response()->json($response);
        }

        return view('admin.categories.index', $response);
    }

    /**
     * Create form
     * @param CreateRequest $request
     * @return Factory|View
     */
    public function create(CreateRequest $request): Factory|View
    {
        return view('admin.categories.create');
    }

    /**
     * Store row
     * @param StoreRequest $request
     * @return JsonResponse|RedirectResponse|Redirector
     * @throws Exception
     */
    public function store(StoreRequest $request): JsonResponse|RedirectResponse|Redirector
    {
        $newItem = $this->categoryService->create($request->validated());
        if ($request->ajax()) {
            return response()->json(['data' => $newItem], 201);
        }

        return redirect(route('admin.categories.index'));
    }

    /**
     * Show row
     * @param ShowRequest $request
     * @param Category $category
     * @return Factory|View
     */
    public function show(ShowRequest $request, Category $category): Factory|View
    {
        return view('admin.categories.show', [
            'data' => $category
        ]);
    }

    /**
     * Edit form
     * @param EditRequest $request
     * @param Category $category
     * @return Factory|View
     */
    public function edit(EditRequest $request, Category $category): Factory|View
    {
        return view('admin.categories.edit', [
            'data' => $category
        ]);
    }


    /**
     * Update row
     * @param UpdateRequest $request
     * @param Category $category
     * @return JsonResponse|RedirectResponse|Redirector
     * @throws Exception
     */
    public function update(UpdateRequest $request, Category $category): JsonResponse|RedirectResponse|Redirector
    {
        $this->categoryService->update($category->id, $request->validated());
        if ($request->ajax()) {
            return response()->json(['data' => $category]);
        }

        return redirect(route('admin.categories.index'));
    }

    /**
     * Destroy row
     * @param DestroyRequest $request
     * @param Category $category
     * @return JsonResponse|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(DestroyRequest $request, Category $category): JsonResponse|RedirectResponse|Redirector
    {
        $this->categoryService->delete($category->id);
        if ($request->ajax()) {
            return response()->json([],204);
        }

        return redirect(route('admin.categories.index'));
    }

    /**
     * Destroy multiple rows
     * @param MassDestroyRequest $request
     * @return JsonResponse|RedirectResponse|Redirector
     * @throws Exception
     */
    public function massDestroy(MassDestroyRequest $request): JsonResponse|RedirectResponse|Redirector
    {
        foreach ($request->get('selected', []) as $id) {
            $this->categoryService->delete($id);
        }
        if ($request->ajax()) {
            return response()->json([],204);
        }

        return redirect(route('admin.categories.index'));
    }

    /**
     * Toggle boolean fields from index table
     * @param ToggleBooleanRequest $request
     * @param Category $category
     * @return JsonResponse
     * @throws Exception
     */
    public function toggleBoolean(ToggleBooleanRequest $request, Category $category): JsonResponse
    {
        if (!in_array($request->get('column_name'), $category->getTableColumns()) ||
                    $category->getKeyType( $request->get('column_name')) !== 'int') {
                        abort(400,'Wrong column!');
                    }
        $this->categoryService->update($category->id, [
            $request->get('column_name') => $request->get('value')
        ]);

        return response()->json(['data' => $category]);
    }
}
