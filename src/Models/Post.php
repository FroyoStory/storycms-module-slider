<?php

namespace Story\Cms\Models;

use Story\Core\Model;
use Dimsav\Translatable\Translatable;
use Story\Cms\Models\Observers\PostObserver;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use Translatable;
    use SoftDeletes;

    const DRAFT = 'DRAFT';
    const PUBLISHED = 'PUBLISHED';
    const PENDING = 'PENDING';
    const PAGE = 'PAGE';
    const POST = 'POST';

    public $translationModel = 'Story\Cms\Models\Translatable\PostTranslation';
    public $translatedAttributes = [
        'title', 'body', 'meta_title', 'meta_description', 'meta_keyword',
        'image_thumbnail'
    ];

    protected $dates    = ['published_at'];
    protected $fillable = ['category_id', 'slug', 'user_id', 'status', 'type', 'published_at'];
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
     * Return the user relationship
     *
     * @return \Story\Cms\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Return the category relationship
     *
     * @return \Story\Cms\Models\Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Return the category relationship
     *
     * @return \Story\Cms\Models\Media
     */
    public function media()
    {
        return $this->hasMany(Media::class);
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

    public function getPrev()
    {
        return $this->where('type', $this->type)
               ->where('status', self::PUBLISHED)
               ->where('id', '<' , $this->id)
               ->first();
    }

    public function getNext()
    {
        return $this->where('type', $this->type)
               ->where('status', self::PUBLISHED)
               ->where('id', '>' , $this->id)
               ->first();
    }

}
