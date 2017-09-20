<?php

namespace Story\Cms;

use Kalnoy\Nestedset\NodeTrait;
use Story\Cms\Contracts\StoryMenu;
use Themsaid\Multilingual\Translatable;


class Menu extends Model implements StoryMenu
{
    use NodeTrait;
    use Translatable;

    protected $table = 'menus';
    protected $fillable = ['name', 'url', 'parent_id', 'post_id', 'user_id', 'active'];

    public $translatable = ['name'];
    public $casts = ['name' => 'array'];

    public function parent()
    {
        return $this->belongsTo(resolve(Contracts\StoryMenu::class), 'parent_id');
    }
}
