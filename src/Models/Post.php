<?php

namespace Story\Cms\Models;

use Story\Core\Model;
use Dimsav\Translatable\Translatable;
use Story\Cms\Models\Observers\PostObserver;

class Post extends Model
{
    use Translatable;

    public $translationModel = 'Story\Cms\Models\Translatable\PostTranslation';
    public $translatedAttributes = [
        'slug', 'title', 'body', 'meta_title', 'meta_description', 'meta_keyword',
        'image_thumbnail', 'summary', 'link',
    ];

    protected $dates    = ['published_at'];
    protected $fillable = ['category_id', 'user_id', 'status', 'type', 'published_at'];
    protected $table    = 'posts';
    protected $with     = ['translations'];

    /**
     * Bootstraping eloquent models to use custome observer
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        static::observe(new PostObserver);
    }

    /**
     * Get recommended article
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRecommendedAttribute()
    {
        return $this->where('type', 'POST')
            ->where('status', 'PUBLISHED')
            ->where('id', '!=', $this->id)->limit(3)
            ->get();
    }

}
