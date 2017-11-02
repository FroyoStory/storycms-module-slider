<?php

namespace Story\Framework\Repositories\PostType;

use Story\Framework\Repositories\Repository;
use Story\Framework\Contracts\StoryPost;
use Story\Framework\Contracts\StoryPostRepository;

class MediaRepository extends Repository implements StoryPostRepository
{
    /**
     * The media repository instance
     *
     * @var Story\Framework\Contracts\StoryPost
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
