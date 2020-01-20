<?php
/**
* CodersStudio 2019
* https://coders.studio
* info@coders.studio
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
use App\Category;


/**
 * Class CRUDController
 * @package CodersStudio\CRUD\Http\Controllers
 */
class CategoryController extends Controller
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
            
        ];
        $model = new Category();
        $data = $model->search($fields, $request->all());
        $data = $data->paginate($request->get('per_page', 10));
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(CreateRequest $request)
    {
        return view('admin.categories.create');
    }

    /**
     * Store row
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreRequest $request)
    {
        $newItem = Category::create($request->all());
        if ($request->ajax()) {
            return response()->json(['data' => $newItem], 201);
        }
        return redirect(route('{{pluralName}}.index'));
    }

    /**
     * Show row
     * @param ShowRequest $request
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(ShowRequest $request, Category $category)
    {
        return view('admin.categories.show', [
            'data' => $category
        ]);
    }

    /**
     * Edit form
     * @param EditRequest $request
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(EditRequest $request, Category $category)
    {
        return view('admin.categories.edit', [
            'data' => $category
        ]);
    }


    /**
     * Update row
     * @param UpdateRequest $request
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateRequest $request, Category $category)
    {
        $category->update($request->all());
        if ($request->ajax()) {
            return response()->json(['data' => $category]);
        }
        return redirect('/admin.categories');
    }

    /**
     * Destroy row
     * @param DestroyRequest $request
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(DestroyRequest $request, Category $category)
    {
        $category->delete();
        if ($request->ajax()) {
            return response()->json([],204);
        }
        return redirect('/admin.categories');
    }

    /**
     * Destroy multiple rows
     * @param MassDestroyRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function massDestroy(MassDestroyRequest $request)
    {
        $forDestroy = Category::whereIn('id',$request->get('selected'))->get();
        foreach ($forDestroy as $item) {
            $item->delete();
        }
        if ($request->ajax()) {
            return response()->json([],204);
        }
        return redirect('/admin.categories');
    }

    /**
     * Toggle boolean fields from index table
     * @param ToggleBooleanRequest $request
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleBoolean(ToggleBooleanRequest $request, Category $category)
    {
        if (!in_array($request->get('column_name'), $category->getTableColumns()) ||
                    $category->getKeyType( $request->get('column_name')) != 'int') {
                        abort(400,'Wrong column!');
                    }
        $category->update([$request->get('column_name') => $request->get('value')]);
        return response()->json(['data' => $category]);
    }
}
