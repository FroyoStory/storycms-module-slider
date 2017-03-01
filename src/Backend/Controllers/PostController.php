<?php

namespace Story\Cms\Backend\Controllers;

use Illuminate\Http\Request;
use Story\Cms\Models\Repositories\PostRepository;
use Story\Cms\Models\Repositories\CategoryRepository;
use Story\Cms\Backend\Requests\PostRequest;

class PostController extends Controller
{
    protected $post;
    protected $category;

    public function __construct(PostRepository $post, CategoryRepository $category)
    {
        $this->post = $post;
        $this->category = $category;
    }

    public function index()
    {
        $this->data['posts'] = $this->post->all();

        return $this->view('post.index');
    }

    public function create()
    {
        $this->data['categories'] = $this->category->all();

        return $this->view('post.create');
    }

    public function store(PostRequest $request)
    {
        $post = $this->post->create($request);

        if (!$post) {
            session()->flash('message', 'Unable to create post');
        } else {
            session()->flash('info', 'Post was created');
        }

        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        $post = $this->post->findById($id);

        $this->data['pk']       = $id;
        $this->data['post']     = $post;
        $this->data['trans']    = $post->translate($request->input('locale'));
        $this->data['categories'] = $this->category->all();

        return $this->view('post.edit');
    }

    public function update(PostRequest $request, $id)
    {
        $post = $this->post->findById($id);
        $post = $this->post->update($post, $request);

        if (!$post) {
            session()->flash('message', 'Unable to create post');
        } else {
            session()->flash('info', 'Post was updated');
        }

        return redirect()->back();
    }

    public function destroy()
    {

    }
}
