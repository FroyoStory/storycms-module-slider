<?php

namespace Story\Cms\Config;

class ConfigManager
{
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
     * Get persistant configuration.
     *
     * @param  string $name
     * @return null|Story\Cms\Config\Config
     */
    public function get(string $name)
    {
        $config = Config::where('name', $name)->first();

        if ($config) {
            $result = json_decode($config->value);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $result;
            }
            return $config->value;
        }
        return null;
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
