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

    /**
     * Update post by given id
     *
     * @param  StoryRole $role
     * @param  array    $data
     * @return false|Story\Cms\Contracts\StoryRole
     */
    public function update(StoryPost $post, array $data)
    {
        foreach ($data as $key => $value) {
            $post->{$key} = $value;
        }

        if ($post->save()) {
            return $post;
        }
        return false;
    }

    /**
     * Destroy media by given id
     *
     * @param  StoryPost $post
     * @return bool
     */
    public function destroy(StoryPost $post)
    {
        return $post->delete();
    }

    /**
     * Find post by given id
     *
     * @param  int $id
     * @return \Story\Cms\Contracts\StoryPost
     */
    public function findById(int $id)
    {
        return $this->posts->find($id);
    }

    /**
     * Find post by given slug string
     *
     * @param  string $slug
     * @return \Story\Cms\Contracts\StoryPost
     */
    public function findBySlug(string $slug)
    {
        return $this->posts->where('slug', $slug)->first();
    }

    /**
     * Find post by given type
     *
     * @param  string $type
     * @return \Story\Cms\Contracts\StoryPost
     */
    public function findByType(string $type)
    {
        return $this->posts->where('type', $type)->paginate();
    }

    /**
     * Synchronize hasMany Relation
     *
     * @param  string $type
     * @return \Story\Cms\Contracts\StoryPost
     */
    public function sync(array $categories)
    {
        $post = resolve(\Story\Cms\Contracts\StoryPost::class)->create($data);
        return $post->category()->sync($categories);
    }
}
