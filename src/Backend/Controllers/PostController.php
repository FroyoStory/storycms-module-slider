<?php

namespace Story\Cms\Backend\Controllers;

use Illuminate\Http\Request;
use Story\Cms\Contracts\StoryPostRepository;
use Story\Cms\Contracts\StoryCategoryRepository;

class PostController extends Controller
{
    protected $post;
    protected $category;

    public function __construct(StoryPostRepository $post, StoryCategoryRepository $category)
    {
        $this->post = $post;
        $this->category = $category;
    }

    public function index(Request $request)
    {
        if ($request->has('type')) {
            $posts = $this->post->findByType($request->input('type'));
        } else {
            $posts = $this->post->findByType('post');
        }


        // $this->data['posts'] = $this->post->all();

        return $this->view('cms::post.index', compact('posts'));
    }

    public function create()
    {
        // $this->data['categories'] = $this->category->all();
        // $this->data['tabs'] = Hook::get('backend', $this->data)['post-editor'];

        return $this->view('cms::post.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'slug'  => 'required|unique:posts,slug',
            'content' => 'required',
        ]);

        $data = $request->only(
            'title', 'slug', 'content', 'post_status',
            'comment_status', 'type', 'categories'
        );

        $data = array_merge($data, [
            'user_id' => $request->user('id')
        ]);
        $post = $this->post->create($data);

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

        $this->data['tabs'] = Hook::get('backend', $this->data)['post-editor'];

        return $this->view('post.edit');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'slug'  => 'required',
            'content' => 'required',
        ]);

        $post = $this->post->findById($id);
        $post = $this->post->update($post, $request);

        if (!$post) {
            session()->flash('message', 'Unable to create post');
        } else {
            session()->flash('info', 'Post was updated');
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $post = $this->post->findById($id);

        $post_delete = $this->post->delete($post);

        if (!$post_delete) {
            session()->flash('message', 'Unable to delete post');
        } else {
            session()->flash('info', 'Post was deleted');
        }

        return redirect()->back();
    }
}
