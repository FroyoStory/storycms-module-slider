<?php

namespace Story\Framework;

use Story\Framework\Contracts\StoryPost;
use JsonSerializable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

class PostAttribute implements JsonSerializable, Jsonable, Arrayable
{
    /**
     * The StoryPost implementation.
     *
     * @var Story\Framework\Contracts\StoryPost
     */
    protected $post;

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Fill the attributes
     *
     * @param  StoryPost $post
     * @return void
     */
    public function fill(StoryPost $post)
    {
        $this->post = $post;

        foreach ($post->metas as $attribute) {
            $this->setAttribute($attribute->name, $attribute->value);
        }

        return $this;
    }

    /**
     * Save the attributes value
     *
     * @return $this
     */
    public function save()
    {
        foreach ($this->attributes as $name => $value) {
            $this->post->metas()->updateOrCreate(compact('name'), compact('value'));
        }

        return $this;
    }

    /**
     * Set meta attribute for given post
     *
     * @param string $name
     * @param mix $value
     */
    public function setAttribute($name, $value)
    {
        $this->attributes[$name] = $value;

        return $this;
    }

    /**
     * Get meta attribute for given post key
     *
     * @param  string $name
     * @return mixed
     */
    public function getAttribute($name)
    {
        return array_key_exists($name, $this->attributes) ? $this->attributes[$name] : null;
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
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->attributes;
    }

     /**
     * Convert the object to its JSON representation.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        $json = json_encode($this->jsonSerialize(), $options);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new \Exception("Unable to confert to json", 1);
        }

        return $json;
    }

    /**
     * Check if is an json
     *
     * @return boolean
     */
    public function isJson($string)
    {
       return is_string($string) && is_array(json_decode($string, true)) ? true : false;
    }

     /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Convert the model to its string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
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
