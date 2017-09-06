<?php

namespace Story\Cms\Config;

class ConfigManager
{
    /**
     * The config's attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Create a new config instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes)
    {
        $this->fill($attributes);
    }

    /**
     * [instance description]
     *
     * @return $this
     */
    public function instance()
    {
        return $this;
    }

    /**
     * Fill the config with an array of attributes.
     *
     * @param  array  $attributes
     * @return $this
     */
    public function fill($attributes)
    {
        foreach ($attributes as $item) {
            $this->setAttribute($item['name'], $item['value']);
        }

        return $this;
    }

    /**
     * Set a given attribute on the model.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return $this
     */
    public function setAttribute($key, $value)
    {
        $this->attributes[$key] = new Item($value);

        return $this;
    }

     /**
     * Get an attribute from the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        if (array_key_exists($key, $this->attributes)) {
            return $this->attributes[$key];
        }

        return null;
    }

    /**
     * Get all of the current attributes on the model.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->getAttribute($key);
    }

    /**
     * Set persistant configuration
     *
     * @param string $name
     * @param string $value
     */
    public function set(string $name, $value = '')
    {
        $name = strtoupper($name);

        return Config::updateOrCreate(compact('name'), compact('value'));
    }

    /**
     * Get all configuration
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Config::all();
    }
}
