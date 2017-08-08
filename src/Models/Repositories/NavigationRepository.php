<?php

namespace Story\Cms\Models\Repositories;

use App;
use Illuminate\Http\Request;
use Story\Cms\Models\Navigation;

class NavigationRepository
{
    public function getById($id)
    {
        return Navigation::find($id);
    }

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

    /**
     * Update menu
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $menu = $this->getById($id);
        $menu->name = $request->input('name');
        $menu->slug = $request->input('slug');
        $menu->visibility = $request->input('visibility') ? 1 : 0;

        return $menu->save();
    }
}
