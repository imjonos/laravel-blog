<?php
/**
* CodersStudio 2019
* https://coders.studio
* info@coders.studio
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\{
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
use App\Post;


/**
 * Class CRUDController
 * @package CodersStudio\CRUD\Http\Controllers
 */
class PostController extends Controller
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
            'name',
            'slug',
            'publish',
            'preview_text',
            'detail_text',
            
        ];
        $model = new Post();
        $data = $model->search($fields, $request->all());
        $data = $data->paginate($request->get('per_page', 10));
        $response = [
            'data' => $data,
            'selected' => [
                'id' => $request->get('id'),
                'name' => $request->get('name'),
                'slug' => $request->get('slug'),
                'publish' => $request->get('publish'),
                'preview_text' => $request->get('preview_text'),
                'detail_text' => $request->get('detail_text'),
                
            ]
        ];
        if ($request->ajax()) {
            return response()->json($response);
        }
        return view('admin.posts.index', $response);
    }

    /**
     * Create form
     * @param CreateRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(CreateRequest $request)
    {
        return view('admin.posts.create');
    }

    /**
     * Store row
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreRequest $request)
    {
        $newItem = Post::create($request->all());
        if ($request->ajax()) {
            return response()->json(['data' => $newItem], 201);
        }
        return redirect(route('{{pluralName}}.index'));
    }

    /**
     * Show row
     * @param ShowRequest $request
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(ShowRequest $request, Post $post)
    {
        return view('admin.posts.show', [
            'data' => $post
        ]);
    }

    /**
     * Edit form
     * @param EditRequest $request
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(EditRequest $request, Post $post)
    {
        return view('admin.posts.edit', [
            'data' => $post
        ]);
    }


    /**
     * Update row
     * @param UpdateRequest $request
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateRequest $request, Post $post)
    {
        $post->update($request->all());
        if ($request->ajax()) {
            return response()->json(['data' => $post]);
        }
        return redirect('/admin.posts');
    }

    /**
     * Destroy row
     * @param DestroyRequest $request
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(DestroyRequest $request, Post $post)
    {
        $post->delete();
        if ($request->ajax()) {
            return response()->json([],204);
        }
        return redirect('/admin.posts');
    }

    /**
     * Destroy multiple rows
     * @param MassDestroyRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function massDestroy(MassDestroyRequest $request)
    {
        $forDestroy = Post::whereIn('id',$request->get('selected'))->get();
        foreach ($forDestroy as $item) {
            $item->delete();
        }
        if ($request->ajax()) {
            return response()->json([],204);
        }
        return redirect('/admin.posts');
    }

    /**
     * Toggle boolean fields from index table
     * @param ToggleBooleanRequest $request
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleBoolean(ToggleBooleanRequest $request, Post $post)
    {
        if (!in_array($request->get('column_name'), $post->getTableColumns()) ||
                    $post->getKeyType( $request->get('column_name')) != 'int') {
                        abort(400,'Wrong column!');
                    }
        $post->update([$request->get('column_name') => $request->get('value')]);
        return response()->json(['data' => $post]);
    }
}
