<?php
/**
* CodersStudio 2019
* https://coders.studio
* info@coders.studio
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Comment\{
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
use App\Comment;
use App\Post;


/**
 * Class CRUDController
 * @package CodersStudio\CRUD\Http\Controllers
 */
class CommentController extends Controller
{
    /**
     * List of records
     * @param IndexRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(IndexRequest $request)
    {
        $fields = [
            'id',
            'user_name',
            'publish',
            'comment',
            'post_id',
            
        ];
        $model = new Comment();
        $data = $model->search($fields, $request->all());
        $data = $data->paginate($request->get('per_page', 10));
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
     * Create form
     * @param CreateRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(CreateRequest $request)
    {
        return view('admin.comments.create');
    }

    /**
     * Store row
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreRequest $request)
    {
        $newItem = Comment::create($request->all());
        if ($request->ajax()) {
            return response()->json(['data' => $newItem], 201);
        }
        return redirect(route('{{pluralName}}.index'));
    }

    /**
     * Show row
     * @param ShowRequest $request
     * @param Comment $comment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(ShowRequest $request, Comment $comment)
    {
        return view('admin.comments.show', [
            'data' => $comment
        ]);
    }

    /**
     * Edit form
     * @param EditRequest $request
     * @param Comment $comment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(EditRequest $request, Comment $comment)
    {
        return view('admin.comments.edit', [
            'data' => $comment
        ]);
    }


    /**
     * Update row
     * @param UpdateRequest $request
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateRequest $request, Comment $comment)
    {
        $comment->update($request->all());
        if ($request->ajax()) {
            return response()->json(['data' => $comment]);
        }
        return redirect('/admin.comments');
    }

    /**
     * Destroy row
     * @param DestroyRequest $request
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(DestroyRequest $request, Comment $comment)
    {
        $comment->delete();
        if ($request->ajax()) {
            return response()->json([],204);
        }
        return redirect('/admin.comments');
    }

    /**
     * Destroy multiple rows
     * @param MassDestroyRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function massDestroy(MassDestroyRequest $request)
    {
        $forDestroy = Comment::whereIn('id',$request->get('selected'))->get();
        foreach ($forDestroy as $item) {
            $item->delete();
        }
        if ($request->ajax()) {
            return response()->json([],204);
        }
        return redirect('/admin.comments');
    }

    /**
     * Toggle boolean fields from index table
     * @param ToggleBooleanRequest $request
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleBoolean(ToggleBooleanRequest $request, Comment $comment)
    {
        if (!in_array($request->get('column_name'), $comment->getTableColumns()) ||
                    $comment->getKeyType( $request->get('column_name')) != 'int') {
                        abort(400,'Wrong column!');
                    }
        $comment->update([$request->get('column_name') => $request->get('value')]);
        return response()->json(['data' => $comment]);
    }
}
