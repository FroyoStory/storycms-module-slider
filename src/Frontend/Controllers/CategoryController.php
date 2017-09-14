<?php

namespace Story\Cms\Frontend\Controllers;

use Story\Cms\Contracts\StoryCategoryRepository;
use Story\Cms\Contracts\StoryPostRepository;

class CategoryController extends Controller
{
    /**
     * The StoryCategoryRepository implementation.
     *
     * @var Story\Cms\Contracts\StoryCategoryRepository
     */
    protected $categories;

    /**
     * The StoryPostRepository implementation.
     *
     * @var Story\Cms\Contracts\StoryPostRepositor
     */
    protected $posts;

    /**
     * Create new controller.
     *
     * @param StoryCategoryRepository $categories
     * @param StoryPostRepository $posts
     */
    public function __construct(StoryCategoryRepository $categories, StoryPostRepository $posts)
    {
        $this->categories = $categories;
        $this->posts = $posts;
    }

    /**
     * Show category page by given category slug url
     *
     * @param  string $name
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        $category = $this->categories->findBySlug($name);
        $posts = $this->posts->findAllPostFromCategory($category);

        return $this->view('category', compact('category', 'posts'));
    }
}
