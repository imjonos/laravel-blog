<?php
/**
 * Eugeny Nosenko 2022
 * https://toprogram.ru
 * info@toprogram.ru
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\{CreateRequest,
    DestroyRequest,
    EditRequest,
    IndexRequest,
    MassDestroyRequest,
    ShowRequest,
    StoreRequest,
    ToggleBooleanRequest,
    UpdateRequest
};
use App\Models\Post;
use App\Services\PostService;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Nos\CRUD\Traits\FileUploadable;

/**
 * Class CRUDController
 * @package Nos\CRUD\Http\Controllers
 */
final class PostController extends Controller
{
    use FileUploadable;

    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
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
            'preview_text',
            'detail_text',
            'category_id',
            'user_id',

        ];
        $with = [
            'category',
            'user'
        ];
        $limit = $request->get('per_page', 10);
        $data = $this->postService->search($request->all(), $fields, $with, $limit);
        $response = [
            'data' => $data,
            'selected' => [
                'id' => $request->get('id'),
                'name' => $request->get('name'),
                'slug' => $request->get('slug'),
                'publish' => $request->get('publish'),
                'preview_text' => $request->get('preview_text'),
                'detail_text' => $request->get('detail_text'),
                'category_id' => $request->get('category_id'),
                'user_id' => $request->get('user_id'),

            ]
        ];
        if ($request->ajax()) {
            return response()->json($response);
        }

        return view('admin.posts.index', $response);
    }

    /**
     * Store row
     * @param StoreRequest $request
     * @return JsonResponse|RedirectResponse|Redirector
     * @throws Exception
     */
    public function store(StoreRequest $request): JsonResponse|RedirectResponse|Redirector
    {
        $newItem = $this->postService->create($request->validated());
        $this->upload($request, $newItem);
        if ($request->ajax()) {
            return response()->json(['data' => $newItem], 201);
        }

        return redirect(route('admin.posts.index'));
    }

    /**
     * Create form
     * @param CreateRequest $request
     * @return Factory|View
     */
    public function create(CreateRequest $request): Factory|View
    {
        return view('admin.posts.create');
    }

    /**
     * Show row
     * @param ShowRequest $request
     * @param Post $post
     * @return Factory|View
     */
    public function show(ShowRequest $request, Post $post): Factory|View
    {
        return view('admin.posts.show', [
            'data' => $post
        ]);
    }

    /**
     * Edit form
     * @param EditRequest $request
     * @param Post $post
     * @return Factory|View
     */
    public function edit(EditRequest $request, Post $post): Factory|View
    {
        return view('admin.posts.edit', [
            'data' => $post
        ]);
    }

    /**
     * Destroy row
     * @param DestroyRequest $request
     * @param Post $post
     * @return JsonResponse|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(DestroyRequest $request, Post $post): JsonResponse|RedirectResponse|Redirector
    {
        $this->postService->delete($post->id);
        if ($request->ajax()) {
            return response()->json([], 204);
        }

        return redirect(route('admin.posts.index'));
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
            $this->postService->delete($id);
        }
        if ($request->ajax()) {
            return response()->json([], 204);
        }

        return redirect(route('admin.posts.index'));
    }

    /**
     * Toggle boolean fields from index table
     * @param ToggleBooleanRequest $request
     * @param Post $post
     * @return JsonResponse
     * @throws Exception
     */
    public function toggleBoolean(ToggleBooleanRequest $request, Post $post): JsonResponse
    {
        if (!in_array($request->get('column_name'), $post->getTableColumns()) ||
            $post->getKeyType($request->get('column_name')) !== 'int') {
            abort(400, 'Wrong column!');
        }
        $this->postService->update($post->id, [
            $request->get('column_name') => $request->get('value')
        ]);

        return response()->json(['data' => $post]);
    }

    /**
     * Update row
     * @param UpdateRequest $request
     * @param Post $post
     * @return JsonResponse|RedirectResponse|Redirector
     * @throws Exception
     */
    public function update(UpdateRequest $request, Post $post): JsonResponse|RedirectResponse|Redirector
    {
        $this->upload($request, $post);
        $this->postService->update($post->id, $request->validated());
        if ($request->ajax()) {
            return response()->json(['data' => $post]);
        }

        return redirect(route('admin.posts.index'));
    }
}
