<?php

namespace Story\Cms\Models;

use Story\Core\Model;
use Dimsav\Translatable\Translatable;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;
    use Translatable;

    public $translationModel = 'Story\Cms\Models\Translatable\CategoryTranslation';
    public $translatedAttributes = ['name', 'description', 'link'];

    protected $table = 'categories';
    protected $with = ['translations'];
    protected $fillable = ['parent_id', 'slug'];

    /**
     * Get child category based on id instance
     *
     * @return \Illuminate\Database\Eloquent\Collections
     */
    public function getChildAttribute()
    {
        return $this->where('parent_id', $this->id)->get();
    }

    /**
     * The post relationship
     *
     * @return \Illuminate\Database\Eloquent\Collections
     */
    public function post()
    {
        return $this->hasMany(Post::class);
    }
}
