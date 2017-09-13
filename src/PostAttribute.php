<?php

namespace Story\Cms;

use Story\Cms\Contracts\StoryPost;

class PostAttribute
{
    /**
     * The StoryPost implementation.
     *
     * @var Story\Cms\Contracts\StoryPost
     */
    protected $post;

    /**
     * Create new meta attribute for given post
     *
     * @param StoryPost $post
     */
    public function __construct(StoryPost $post)
    {
        $this->post = $post;
    }

    /**
     * Set meta attribute for given post
     *
     * @param string $name
     * @param mix $value
     */
    public function setAttribute(string $name, $value)
    {
        $this->post->metas()->updateOrCreate(compact('name'), compact('value'));
    }

    /**
     * Get meta attribute for given post key
     *
     * @param  string $name
     * @return mixed
     */
    public function getAttribute(string $name)
    {
        $attribute = $this->post->metas->filter(function($item) use($name) {
            return $item->name == $name;
        })->first();

        return $attribute  ? $attribute->value : null;
    }

    /**
     * Shortcut to get all attributes
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->post->metas;
    }

    /**
     * Dynamically set attribute
     *
     * @param string $name
     * @param mixed $value
     */
    public function __set(string $name, $value)
    {
        return $this->setAttribute($name, $value);
    }

    /**
     * Get attribute
     *
     * @param  string $name
     * @return mix
     */
    public function __get($name)
    {
        return $this->getAttribute($name);
    }

}
