<?php

namespace Story\Cms\Models\Repositories;

use Illuminate\Http\Request;
use Story\Cms\Models\Navigation;

class NavigationRepository
{
    public static function set($name, $slug)
    {

    }

    public static function get($name)
    {
        $nav = Navigation::where('code', $name)->first();

        if ($nav) {
            return $nav->descendants()->get()->toTree();
        }

        return [];
    }
}
