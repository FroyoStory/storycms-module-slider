<?php

namespace Story\Cms\Models\Translatable;

use App;
use Story\Core\Model;
use Story\Cms\Models\Post;
use Story\Cms\Models\Observers\PostTranslationObserver;
use Illuminate\Support\Str;
use DiDom\Document;

class PostTranslation extends Model
{
    public $timestamps = false;

    protected $table    = 'trans_posts';
    protected $fillable = ['slug', 'title', 'excerpt','body', 'meta_title', 'meta_description', 'meta_keyword'];
    protected $appends = ['image_thumbnail', 'summary', 'link'];

    /**
     * Bootstraping eloquent models to use custome observer
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        static::observe(new PostTranslationObserver);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get summary article atribute
     *
     * @return string
     */
    public function getSummaryAttribute()
    {
        return Str::limit($this->body, 200);
    }

    /**
     * Get thumbnail data for article
     *
     * @return string
     */
    public function getImageThumbnailAttribute()
    {
        if ($this->post->media->count() > 0) {
            $images = $this->post->media->filter(function($item) {
                return $item->type != 'mp4';
            })->values();

            return $images->first()->url;
        } else {
            $document = new Document($this->attributes['body']);
            $images   = $document->find('img');
            return count($images) > 0 ? array_first($images)->getAttribute('src') : '';
        }
    }

    /**
     * Get post link attribute
     *
     * @return string
     */
    public function getLinkAttribute()
    {
        if ($this->post->type == 'PAGE') {
            return '/'. $this->locale . '/' . $this->slug;
        } elseif ($this->post->type == 'POST') {
            return '/'. $this->locale . '/blogs/' . $this->slug;
        }
    }
}
