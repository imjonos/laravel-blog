<?php
/**
 * Eugeny Nosenko 2022
 * https://toprogram.ru
 * info@toprogram.ru
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Comment\{CreateRequest,
    DestroyRequest,
    EditRequest,
    IndexRequest,
    MassDestroyRequest,
    ShowRequest,
    StoreRequest,
    ToggleBooleanRequest,
    UpdateRequest
};
use App\Models\Comment;
use App\Services\CommentService;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;


/**
 * Class CRUDController
 * @package Nos\CRUD\Http\Controllers
 */
final class CommentController extends Controller
{
    protected CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
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
            'user_name',
            'publish',
            'comment',
            'post_id',
            'created_at'

        ];
        $with = [
            'post'
        ];
        $limit = $request->get('per_page', 10);
        $data = $this->commentService->search($request->all(), $fields, $with, $limit);
        $response = [
            'data' => $data,
            'selected' => [
                'id' => $request->get('id'),
                'user_name' => $request->get('user_name'),
                'publish' => $request->get('publish'),
                'comment' => $request->get('comment'),
                'post_id' => $request->get('post_id'),

            ]
        ];
        if ($request->ajax()) {
            return response()->json($response);
        }

        return view('admin.comments.index', $response);
    }

    /**
     * Store row
     * @param StoreRequest $request
     * @return JsonResponse|RedirectResponse|Redirector
     * @throws Exception
     */
    public function store(StoreRequest $request): JsonResponse|RedirectResponse|Redirector
    {
        $newItem = $this->commentService->create($request->validated());
        if ($request->ajax()) {
            return response()->json(['data' => $newItem], 201);
        }

        return redirect(route('admin.comments.index'));
    }

    /**
     * Create form
     * @param CreateRequest $request
     * @return Factory|View
     */
    public function create(CreateRequest $request): Factory|View
    {
        return view('admin.comments.create');
    }

    /**
     * Show row
     * @param ShowRequest $request
     * @param Comment $comment
     * @return Factory|View
     */
    public function show(ShowRequest $request, Comment $comment): Factory|View
    {
        return view('admin.comments.show', [
            'data' => $comment
        ]);
    }

    /**
     * Edit form
     * @param EditRequest $request
     * @param Comment $comment
     * @return Factory|View
     */
    public function edit(EditRequest $request, Comment $comment): Factory|View
    {
        return view('admin.comments.edit', [
            'data' => $comment
        ]);
    }

    /**
     * Destroy row
     * @param DestroyRequest $request
     * @param Comment $comment
     * @return JsonResponse|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(DestroyRequest $request, Comment $comment): JsonResponse|RedirectResponse|Redirector
    {
        $this->commentService->delete($comment->id);
        if ($request->ajax()) {
            return response()->json([], 204);
        }

        return redirect(route('admin.comments.index'));
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
            $this->commentService->delete($id);
        }
        if ($request->ajax()) {
            return response()->json([], 204);
        }

        return redirect(route('admin.comments.index'));
    }

    /**
     * Toggle boolean fields from index table
     * @param ToggleBooleanRequest $request
     * @param Comment $comment
     * @return JsonResponse
     * @throws Exception
     */
    public function toggleBoolean(ToggleBooleanRequest $request, Comment $comment): JsonResponse
    {
        if (!in_array($request->get('column_name'), $comment->getTableColumns()) ||
            $comment->getKeyType($request->get('column_name')) !== 'int') {
            abort(400, 'Wrong column!');
        }
        $this->commentService->update($comment->id, [
            $request->get('column_name') => $request->get('value')
        ]);

        return response()->json(['data' => $comment]);
    }

    /**
     * Update row
     * @param UpdateRequest $request
     * @param Comment $comment
     * @return JsonResponse|RedirectResponse|Redirector
     * @throws Exception
     */
    public function update(UpdateRequest $request, Comment $comment): JsonResponse|RedirectResponse|Redirector
    {
        $this->commentService->update($comment->id, $request->validated());
        if ($request->ajax()) {
            return response()->json(['data' => $comment]);
        }

        return redirect(route('admin.comments.index'));
    }
}
