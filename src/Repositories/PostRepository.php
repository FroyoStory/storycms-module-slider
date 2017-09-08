<?php

namespace Story\Cms\Repositories;

use Story\Cms\Contracts\StoryPost;
use Story\Cms\Contracts\StoryPostRepository;

class PostRepository extends Repository implements StoryPostRepository
{
    /**
     * The StoryPost implementation.
     *
     * @var Story\Cms\Contracts\StoryPost
     */
    protected $posts;

    /**
     * Create new post instance.
     *
     * @param StoryPost $posts
     */
    public function __construct(StoryPost $posts)
    {
        $this->posts = $posts;
    }

    /**
     * The media class
     *
     * @return Story\Cms\Repositories\MediaRepository
     */
    public function media()
    {
        return new PostType\MediaRepository($this->posts);
    }

    /**
     * Create post data
     *
     * @param  array  $data
     * @return bool|Story\Cms\Contracts\StoryPost
     */
    public function create(array $data)
    {
        $post = $this->posts->create($data);

        if ($post) {
            return $post;
        }
        return false;
    }
}
