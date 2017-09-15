<?php

namespace Story\Cms\Support;

class Plugin
{
    /**
     * Get all local plugins
     *
     * @return void
     */
    public function all()
    {
        $paths = glob(base_path().'/plugins/*/composer.json');

        return collect($paths)->map(function($item) {
            return json_decode(file_get_contents($item));
        })->values();
    }
}
