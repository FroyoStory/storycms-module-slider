<?php

namespace Story\Cms\Frontend\Controllers;

use SEO;
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

        // /{page}
        if ($num_args == 1) {
            $post = $this->posts->findBySlug(func_get_arg(0));

            if ($post && $post->type == 'page') {
                SEO::instance([
                    'title' => $post->title,
                    'description' => $post->content
                ]);
                return $this->view('page', compact('post'));
            }
        // /{cpt}/{post}
        } elseif ($num_args == 2) {
            $post = $this->posts->findBySlug(func_get_arg(1));
            if ($post) {
                SEO::instance([
                    'title' => $post->title,
                    'description' => $post->content
                ]);
                return $this->view('single', compact('post'));
            }
        // /{Y}/{m}/{d}/{post}
        // /{Y}/{m}/{post}
        } else  {
            $post = $this->posts->findBySlug($slug);
            if ($post && $post->type == 'post') {
                SEO::instance([
                    'title' => $post->title,
                    'description' => $post->content
                ]);
                return $this->view('single', compact('post'));
            }
        }

        throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

    }
}
