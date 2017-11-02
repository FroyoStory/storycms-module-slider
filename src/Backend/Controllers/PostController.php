<?php

namespace Story\Framework\Backend\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Story\Framework\Contracts\StoryPostRepository;
use Story\Framework\Contracts\StoryCategoryRepository;
use Theme;

class PostController extends Controller
{
    /**
     * The StoryPostRepository implementation.
     *
     * @var Story\Framework\Contracts\StoryPostRepository
     */
    protected $post;

    /**
     * The StoryCategoryRepository implementation.
     *
     * @var Story\Framework\Contracts\StoryCategoryRepository
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
            $posts = $this->post->getAllByType($request->input('type'));
        } else {
            $posts = $this->post->getAllByType('post');
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
        $categories = $this->category->toTree();
        $templates = Theme::templates();

        return $this->view('cms::post.create', compact('categories', 'templates'));
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
            'title' => 'translatable_required',
            'post_status' => 'required',
            'content' => 'translatable_required',
        ]);

        $request->merge([
            'user_id' => $request->user()->id,
            'slug' => str_slug(array_first($request->input('title'))),
            'comment_status' => $request->input('comment_status') ? : 'closed',
            'publish_date' => $request->input('publish_date') ? Carbon::parse($request->input('publish_date')) : Carbon::now()->format('Y-m-d H:i:s'),
            'type' => $request->input('type') ? : 'post'
        ]);

        $data = $request->only(
            'title', 'slug', 'content', 'excerpt', 'post_status', 'publish_date',
            'comment_status', 'type', 'categories', 'user_id', 'meta', 'tags'
        );

        if ($post = $this->post->create($data)) {

            event(new \Story\Cms\Events\PostCreated($post, $request));

            return response()->json([
                'data' => $post,
                'meta' => ['message' => 'Post is created.']
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
        $categories = $this->category->toTree();
        $templates = Theme::templates();

        return $this->view('cms::post.edit', compact('categories', 'post', 'templates'));
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
            'title' => 'translatable_required',
            'post_status' => 'required',
            'slug' => 'required|unique:posts,slug,'.$id,
            'content' => 'translatable_required',
        ]);

        $request->merge([
            'user_id' => $request->user()->id,
            'comment_status' => $request->input('comment_status') ? : 'closed',
        ]);

        $data = $request->only(
            'title', 'slug', 'content', 'excerpt', 'post_status', 'publish_date',
            'comment_status', 'type', 'categories', 'user_id', 'meta', 'tags'
        );

        if ($post = $this->post->update($this->post->findById($id), $data)) {

            event(new \Story\Cms\Events\PostUpdated($post, $request));

            return response()->json([
                'data' => $post,
                'meta' => ['message' => 'Post is updated.']
            ]);
        }

        return response()->json([
            'meta' => ['message' => 'Unable to update post.']
        ], 422);
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
