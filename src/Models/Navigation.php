<?php

namespace Story\Cms\Models;

use Story\Core\Model;
use Dimsav\Translatable\Translatable;
use Kalnoy\Nestedset\NodeTrait;

class Navigation extends Model
{
    use NodeTrait;
    use Translatable;

    protected $table = 'navigations';
    protected $fillable = ['code', 'visibility', 'url'];
    protected $with = ['translations'];

    public $translationModel = 'Story\Cms\Models\Translatable\NavigationTranslation';
    public $translatedAttributes = ['name', 'slug'];

    public function self()
    {
        return $this->where('parent_id', $this->parent_id)->get();
    }

    public function child()
    {
        return $this->where('parent_id', $this->id)->get();
    }
}
