<?php

namespace Story\Cms\Backend\Controllers;

use Illuminate\Http\Request;
use Story\Cms\Contracts\StoryPostRepository;
use Story\Cms\Contracts\StoryCategoryRepository;

class PostController extends Controller
{
    /**
     * The StoryPostRepository implementation.
     *
     * @var Story\Cms\Contracts\StoryPostRepository
     */
    protected $post;

    /**
     * The StoryCategoryRepository implementation.
     *
     * @var Story\Cms\Contracts\StoryCategoryRepository
     */
    protected $category;

    /**
     * Create new post controller instance.
     *
     * @param StoryPostRepository     $post
     * @param StoryCategoryRepository $category
     */
    public function __construct(StoryPostRepository $post, StoryCategoryRepository $category)
    {
        $this->post = $post;
        $this->category = $category;
    }

    /**
     * Display all post resources.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('type')) {
            $posts = $this->post->findByType($request->input('type'));
        } else {
            $posts = $this->post->findByType('post');
        }

        return $this->view('cms::post.index', compact('posts'));
    }

    /**
     * Display create post form
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->all();

        return $this->view('cms::post.create', compact('categories'));
    }

    /**
     * Handle to store post data
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'slug'  => 'required|unique:posts,slug',
            'content' => 'required',
        ]);

        $request->merge([
            'user_id' => $request->user()->id
        ]);

        $data = $request->only(
            'title', 'slug', 'content', 'post_status',
            'comment_status', 'type', 'categories', 'user_id'
        );

        $post = $this->post->create($data);

        if ($post) {
            return response()->json([
                'data' => $post,
                'meta' => ['message' => 'Post is ctreated.']
            ]);
        }

        return response()->json([
            'meta' => ['message' => 'Unable to create post.']
        ], 422);
    }

    /**
     * Display edit form
     *
     * @param  Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, int $id)
    {
        $post = $this->post->findById($id);
        $categories = $this->category->all();

        return $this->view('post.edit', compact('categories', 'post'));
    }

    /**
     * Update post resources
     *
     * @param  Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
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

    /**
     * Destroy post id
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
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
