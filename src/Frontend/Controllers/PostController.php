<?php

namespace Story\Cms\Frontend\Controllers;

use Story\Cms\Contracts\StoryPostRepository;

class PostController extends Controller
{
    /**
     * The StoryPostRepository implementation.
     *
     * @var Story\Cms\Contracts\StoryPostRepository
     */
    protected $posts;

    /**
     * Create new post controller.
     *
     * @param StoryPostRepository $posts
     */
    public function __construct(StoryPostRepository $posts)
    {
        $this->posts = $posts;
    }

    /**
     * Show available post
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $num_args = func_num_args();
        switch ($num_args) {
            case 4: $slug = func_get_arg(3); break;
            case 3: $slug = func_get_arg(2); break;
            // case 2: $slug = func_get_arg(1); break;
            case 1: $slug = func_get_arg(0); break;
            default: $slug = ''; break;
        }

        // if num_args == 2
        // /{custom_post_type}/{post}
        if ($num_args == 2) {
            $page = $this->posts->findBySlug(func_get_arg(0));
            $post = $this->posts->findBySlug(func_get_arg(1));
        } else  {
            $post = $this->posts->findBySlug($slug);
        }

        return $post;
    }
}
