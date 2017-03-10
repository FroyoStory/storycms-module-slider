<?php

namespace Story\Cms\Models\Repositories;

use Illuminate\Http\Request;
use Story\Cms\Models\Navigation;

class NavigationRepository
{
    public static function set($name, $slug)
    {

    }

    public static function first($name)
    {
        return Navigation::withDepth()->where('code', $name)->first();
    }

    public static function get($name)
    {
        $nav = self::first($name);

        if ($nav) {
            if ($nav->depth > 1) {
                return $nav->self();
            }
            return $nav->descendants()->get()->toTree();
        }

        return [];
    }
}
