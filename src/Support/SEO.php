<?php

namespace Story\Cms\Support;

class SEO
{
    /**
     * The SEO Attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Fill the data
     *
     * @param  array  $data
     * @return void
     */
    public function instance(array $data)
    {
        foreach ($data as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * Set attribute
     *
     * @param string $key
     * @param string $value
     */
    public function set(string $key, string $value)
    {
        return $this->attributes[$key] = $value;
    }

    /**
     * Get attribute
     *
     * @param  string $key
     * @return string
     */
    public function get(string $key)
    {
        if (array_key_exists($key, $this->attributes)) {
            return $this->attributes[$key];
        }
        return null;
    }
}
