<?php

namespace Story\Cms\Support;

use Configuration;
use Illuminate\Support\Facades\Blade;

class Theme
{

    /**
     * Get current theme
     *
     * @return string
     */
    public function current()
    {
        return Configuration::instance()->THEME;
    }

    /**
     * Set current theme
     *
     * @param string $name
     */
    public function set($name)
    {
        return Configuration::set('THEME', $name);
    }

    /**
     * Get theme url
     *
     * @param  string $file
     * @return string
     */
    public function url($file)
    {
        return url('/') .'/themes/'. $this->current() . $file;
    }

    /**
     * Get layout for current theme
     *
     * @param  string $layout
     * @return string
     */
    public function layout($layout = 'app')
    {
        return '@extends(theme::'.$this->current().'.layouts.'.$layout.')';
    }

    /**
     * Get availabe template from current theme
     *
     * @return array
     */
    public function templates()
    {
        $paths = glob(public_path().'/themes/'.$this->current().'/pages/*.php');

        return collect($paths)->map(function($item) {
            return str_replace('.blade.php', '', basename($item));
        });
    }

    /**
     * Get all available story cms theme
     *
     * @return array
     */
    public function all()
    {
        $paths = glob(public_path().'/themes/*/theme.php');

        return collect($paths)->map(function($item) {
            return array_merge(
                require_once $item,
                ['key' => basename(dirname($item))]
            );
        })->values();
    }
}
