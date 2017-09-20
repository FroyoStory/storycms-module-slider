<?php

namespace Story\Cms\Repositories;

use Story\Cms\Contracts\StoryMenu;
use Story\Cms\Contracts\StoryMenuRepository;

class MenuRepository extends Repository implements StoryMenuRepository
{
    /**
     * The StoryMenu model implementation.
     *
     * @var Story\Cms\Contracts\StoryMenu
     */
    protected $menu;

    /**
     * Create story menu repository
     *
     * @param StoryMenu $menu
     */
    public function __construct(StoryMenu $menu)
    {
        $this->menu = $menu;
    }

    /**
     * Fetch all menu from database and paginate it
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        $menus = $this->menu->paginate();

        return $this->paginator($menus);
    }

    public function allExceptRoot()
    {
        $menus = $this->menu->where('id', '!=', 1)->paginate();

        return $this->paginator($menus);
    }

    /**
     * Fetch Menu by given id
     * @param  int $id
     * @return \Story\Cms\Contracts\StoryMenu
     */
    public function findById($id)
    {
        return $this->menu->find($id);
    }

    /**
     * Save a menu base on data
     *
     * @param  array $data
     * @return \Story\Cms\Contracts\StoryMenu
     */
    public function create(array $data)
    {
        return $this->menu->create($data);
    }

    /**
     * Update a menu by given menu Id
     *
     * @param  StoryMenu $menu
     * @param  array         $data
     * @return false|\Story\Cms\Contracts\StoryMenu
     */
    public function update(StoryMenu $menu, array $data)
    {
        foreach ($data as $key => $value) {
            $menu->{$key} = $value;
        }

        if ($menu->save()) {
            return $menu;
        }
        return false;
    }

    /**
     * Destroy a menu by given id
     *
     * @param  StoryMenu $menu
     * @return bool
     */
    public function destroy(StoryMenu $menu)
    {
        return $menu->delete();
    }
}
