<?php

namespace App\Models\Translatable;

use App;
use Story\Core\Model;

class CategoryTranslation extends Model
{
    public $timestamps = false;

    protected $table    = 'trans_categories';
    protected $fillable = ['name', 'slug', 'description'];
    protected $appends  = ['link'];

    /**
     * Get post link attribute
     *
     * @return string
     */
    public function getLinkAttribute()
    {
        return '/'. App::getLocale() . '/blogs?category=' . $this->id;
    }
}
