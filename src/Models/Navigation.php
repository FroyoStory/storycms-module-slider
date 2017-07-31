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
    protected $fillable = ['code', 'slug', 'visibility', 'image_url'];
    protected $with = ['translations'];

    public $translationModel = 'Story\Cms\Models\Translatable\NavigationTranslation';
    public $translatedAttributes = ['name', 'slug'];

    /**
     * Get self siblings
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function self()
    {
        return $this->where('parent_id', $this->parent_id)
            ->where('visibility', true)
            ->get();
    }

    /**
     * Get childs from given instance
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function child()
    {
        return $this->where('parent_id', $this->id)
            ->where('visibility', true)
            ->get();
    }

    /**
     * Get parent from given instance
     *
     * @return \Story\Cms\Models\Navigation
     */
    public function parent()
    {
        if ($this->parent_id != 1) {
            return $this->where('id', $this->parent_id)
                // ->where('visibility', true)
                ->first();
        }

        return false;
    }
}
