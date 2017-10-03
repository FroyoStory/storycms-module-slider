<?php

namespace Story\Cms\Repositories\PostType;

use Story\Cms\Repositories\Repository;
use Story\Cms\Contracts\StoryPost;
use Story\Cms\Contracts\StoryPostRepository;

class MediaRepository extends Repository implements StoryPostRepository
{
    /**
     * The media repository instance
     *
     * @var Story\Cms\Contracts\StoryPost
     */
    protected $posts;

    /**
     * Create new story post media instance
     *
     * @param StoryPost $posts
     */
    public function __construct(StoryPost $posts)
    {
        $this->posts = $posts;
    }

    /**
     * Paginate result
     *
     * @return array
     */
    public function paginate()
    {
        $posts = $this->posts
            ->where('type', $this->posts::TYPE_ATTACHMENT)
            ->paginate();

        return $posts ? $this->paginator($posts) : null;
    }
}
