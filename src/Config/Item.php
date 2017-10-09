<?php

namespace Story\Cms\Config;

use JsonSerializable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

class Item implements Arrayable, Jsonable, JsonSerializable
{
    /**
     * The config's item attributes.
     *
     * @var array
     */
    protected $attribute;

     /**
     * Create a new config item instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct($attribute)
    {
        $this->attribute = $attribute;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        $result = json_decode($this->attribute);

        if (json_last_error() === JSON_ERROR_NONE) {
            return $result;
        }

        return $attribute;
    }

     /**
     * Convert the object to its JSON representation.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        if ($this->isJson($this->attribute)) {
            $json = json_encode($this->jsonSerialize(), $options);

            if (JSON_ERROR_NONE !== json_last_error()) {
                throw new \Exception("Unable to confert to json", 1);
            }

            return $json;
        }

        return $this->attribute ? : '';
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
}
