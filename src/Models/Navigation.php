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

    protected $fillable = ['code'];

    public $translationModel = 'Story\Cms\Models\Translatable\NavigationTranslation';
    public $translatedAttributes = ['name', 'slug'];
}
