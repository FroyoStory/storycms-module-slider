<?php

namespace Story\Cms\Backend\Controllers;

use Story\Cms\Models\Repositories\PostRepository;
use Story\Cms\Backend\Requests\PostRequest;

class PostController extends Controller
{

    protected $posts;

    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function index()
    {
        $this->data['posts'] = $this->posts->get();

        return $this->view('post.index');
    }

    public function create()
    {
        return $this->view('post.create');
    }

    public function store(PostRequest $request)
    {
        $this->posts->create($request);
    }

    public function edit()
    {
        return $this->view('post.create');
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
