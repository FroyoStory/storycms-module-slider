<?php

namespace Story\Cms\Frontend\Controllers;

use Story\Cms\Models\Repositories\PostRepository;
use Illuminate\Http\Request;

class FindController extends Controller
{

    protected $post;

    public function __construct(PostRepository $post)
    {
        $this->post = $post;
    }

    public function index(Request $request)
    {
        $this->data['posts'] = $this->post->search($request);

        return $this->view('search.index');
    }
}
