<?php

namespace Story\Cms\Backend\Controllers;

use Illuminate\Http\Request;
use Story\Cms\Models\Repositories\PageRepository;
use Story\Cms\Backend\Requests\PageRequest;

class PageController extends Controller
{
    protected $page;

    public function __construct(PageRepository $page)
    {
        $this->page = $page;
    }

    public function index()
    {
        $this->data['pages'] = $this->page->all();

        return $this->view('page.index');
    }

    public function create()
    {
        return $this->view('page.create');
    }

    public function store(PageRequest $request)
    {
        $page = $this->page->create($request);

        if (!$page) {
            session()->flash('message', 'Unable to create page');
        } else {
            session()->flash('info', 'Page was created');
        }

        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        $page = $this->page->findById($id);

        $this->data['pk']       = $id;
        $this->data['page']     = $page;
        $this->data['trans']    = $page->translate($request->input('locale'));

        return $this->view('page.edit');
    }

    public function update(PageRequest $request, $id)
    {
        $page = $this->page->findById($id);
        $page = $this->page->update($page, $request);

        if (!$page) {
            session()->flash('message', 'Unable to create page');
        } else {
            session()->flash('info', 'Category was updated');
        }

        return redirect()->back();
    }

    public function destroy()
    {

    }
}
