<?php

namespace Story\Cms\Repositories;

use Story\Cms\Contracts\StoryCategory;
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
            // save categories
            if ($categories = $data['categories']) {
                $post->category()->sync($categories);
            }
            if ($tags = $data['tags']) {
                $post->setTags($tags);
            }

            // save meta data
            foreach ($data['meta'] as $key => $value) {
                $post->meta->{$key} = $value ? : '';
            }
            $post->meta->save();

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
            if ($post->isFillable($key)) {
                $post->{$key} = $value;
            }
        }

        if ($post->save()) {
            // save categories
            if ($categories = $data['categories']) {
                $post->category()->sync($categories);
            }
            if ($tags = $data['tags']) {
                $post->setTags($tags);
            }

            // save meta data
            $meta = $post->meta;
            foreach ($data['meta'] as $key => $value) {
                $meta->{$key} = $value;
            }
            $meta->save();

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
     * Find all post from given category
     *
     * @param  StoryCategory $category
     * @param  string $type
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findAllPostFromCategory(StoryCategory $category, $type = 'post')
    {
        return $category->post()->where('type', $type)->paginate();
    }

    /**
     * Find post by given type
     *
     * @param  string $type
     * @return \Story\Cms\Contracts\StoryPost
     */
    public function getAllByType(string $type)
    {
        return $this->posts->where('type', $type)->paginate();
    }

    /**
     * Search post data
     *
     * @param  string $text
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search(string $text)
    {
        return $this->posts->search($text)->get();
    }
}
