<?php

namespace Story\Cms\Models\Repositories;

use App;
use Illuminate\Http\Request;
use Story\Cms\Models\Navigation;

class NavigationRepository
{
    public static function set($name, $slug)
    {

    }

    public static function findByCode($code)
    {
        return Navigation::where('code', $code)->firstOrFail();
    }

    public static function first($name)
    {
        return Navigation::whereHas('translations', function($query) use ($name) {
            $query->where('slug', $name);
            $query->where('locale', App::getLocale());
        })->firstOrFail();
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
