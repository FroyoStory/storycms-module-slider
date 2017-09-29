<?php

namespace Story\Cms\Backend\Controllers;

use Illuminate\Http\Request;
use Story\Cms\Contracts\StoryCategoryRepository;
use Story\Cms\Backend\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * The StoryCategoryRepository implementation.
     *
     * @var Story\Cms\Contracts\StoryCategoryRepository
     */
    protected $categories;

    /**
     * Create new controller.
     *
     * @param StoryCategoryRepository $categories
     */
    public function __construct(StoryCategoryRepository $categories)
    {
        $this->categories = $categories;
    }

    /**
     * Display all categories
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categories->toTree();
        return $this->view('cms::category.index', compact('categories'));
    }

    /**
     * Create a new category
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'translatable_required',
            'slug' => 'required'
        ]);

        $request->merge([
            'parent_id' => 1
        ]);

        $data = $request->only('name', 'slug', 'description', 'parent_id');
        $category = $this->categories->create($data);

        if (!$category) {
            return response()->json([
                'meta' => ['message' => 'Unable to create category']
            ], 422);
        }

        return response()->json([
            'data' => $category,
            'meta' => ['message' => 'Category was created']
        ]);
    }

    /**
     * Update a category
     *
     * @param  Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Request
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'translatable_required',
            'slug' => 'required'
        ]);

        $data = $request->only('name', 'slug','description');

        if ($category = $this->categories->findById($id)) {
            $category = $this->categories->update($category, $data);
            if (!$category) {
                return response()->json([
                    'meta' => ['message' => 'Unable to update category']
                ], 422);
            }
            return response()->json([
                'data' => $category,
                'meta' => ['message' => 'Category was updated']
            ]);
        }
        return response()->json([
            'data' => [],
            'meta' => ['message' => 'Unable to found category']
        ], 422);
    }

    /**
     * Rebuild the tree
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function rebuild(Request $request)
    {
        $this->validate($request, ['categories' => 'required']);

        if ($this->categories->rebuildTree($request->only('categories'))) {
            return response()->json([
                'data' => [],
                'meta' => ['message' => 'Categories was updated']
            ]);
        }
        return response()->json([
            'data' => [],
            'meta' => ['message' => 'Unable to update categories']
        ], 422);
    }

    /**
     * Destroy category
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        if ($category = $this->categories->findById($id)) {
            if ($this->categories->destroy($category)) {
                return response()->json([
                    'meta' => ['message' => 'Category was destroyed']
                ]);
            }
        }

        return response()->json([
            'meta' => ['message' => 'Unable to destroy category']
        ]);
    }

}
