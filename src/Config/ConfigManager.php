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

        return $config ? $config->value : null;
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
