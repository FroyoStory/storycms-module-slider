<?php

namespace Story\Cms\Backend\Controllers;

use Illuminate\Http\Request;
use Story\Cms\Models\Repositories\CategoryRepository;
use Story\Cms\Backend\Requests\CategoryRequest;

class CategoryController extends Controller
{
    protected $categories;

    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }

    public function index()
    {
        $this->data['categories'] = $this->categories->all();

        return $this->view('category.index');
    }

    public function store(CategoryRequest $request)
    {
        $category = $this->categories->create($request);

        if (!$category) {
            session()->flash('message', 'Unable to create category');
        }

        return redirect()->back();
    }

    public function edit(Request $request)
    {
        return $this->view('category.edit');
    }

    public function update()
    {

    }

    public function destroy()
    {

    }

}
