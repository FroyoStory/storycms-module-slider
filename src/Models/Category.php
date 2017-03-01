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
    public $translatedAttributes = ['name', 'slug', 'description', 'link'];

    protected $table = 'categories';
    protected $with = ['translations'];
    protected $fillable = ['parent_id'];
}
