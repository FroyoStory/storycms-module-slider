<?php

namespace Story\Cms\Models\Translatable;

use App;
use Story\Core\Model;
use Story\Cms\Models\Observers\CategoryTranslationObserver;

class CategoryTranslation extends Model
{
    public $timestamps = false;

    protected $table    = 'trans_categories';
    protected $fillable = ['name', 'slug', 'description'];
    protected $appends  = ['link'];

    /**
     * Bootstraping eloquent models to use custome observer
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        static::observe(new CategoryTranslationObserver);
    }

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
