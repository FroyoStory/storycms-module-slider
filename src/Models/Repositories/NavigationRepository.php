<?php

namespace Story\Cms\Models\Repositories;

use App;
use Illuminate\Http\Request;
use Story\Cms\Models\Navigation;

class NavigationRepository
{

    public function getNavigation($code)
    {
        return Navigation::where('code', $code)->get()->descendants();
    }

    public static function set($name, $slug)
    {

    }

    public static function findByCode($code)
    {
        return Navigation::where('code', $code)
            ->where('visibility', true)
            ->firstOrFail();
    }

    public static function first($name)
    {
        return Navigation::where('slug', $name)
            ->where('visibility', true)
            ->firstOrFail();
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
