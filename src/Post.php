<?php

namespace Story\Cms;

use Configuration;
use Story\Cms\Contracts\StoryPost;
use Themsaid\Multilingual\Translatable;

class Post extends Model implements StoryPost
{
    use Translatable;

    const POST_PUBLISHED = 'publish';
    const POST_DRAFT = 'draft';
    const COMMENT_ENABLE = 'open';
    const COMMENT_DISABLE = 'closed';
    const TYPE_POST = 'post';
    const TYPE_PAGE = 'page';
    const TYPE_ATTACHMENT = 'attachment';

    protected $table = 'posts';
    protected $fillable = [
        'title', 'slug', 'content', 'post_status', 'comment_status', 'type', 'mime_type',
        'user_id', 'parent_id'
    ];

    public $translatable = ['title', 'content'];
    public $casts = [
        'title' => 'array',
        'content' => 'array'
    ];

    /**
     * Get user relationship
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function user()
    {
        return $this->belongsTo(resolve(Contracts\StoryUser::class));
    }

    /**
     * Get all categories relationship
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function category()
    {
        return $this->belongsToMany(
            resolve(Contracts\StoryCategory::class),
            'posts_categories', 'post_id', 'category_id'
        );
    }

    /**
     * Get meta attribute for given post
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function metas()
    {
        return $this->hasMany(resolve(Contracts\StoryPostMeta::class));
    }

    /**
     * Get post meta attribute instance.
     *
     * @return \Story\Cms\PostAttribute
     */
    public function getMetaAttribute()
    {
        return resolve(PostAttribute::class)->fill($this);
    }

    /**
     * Get url attribute value
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        $reserve = ['post', 'page', 'attachment'];
        $url = Configuration::instance()->SITE_PERMALINK;

        $formatter = [
            '{postname}' => $this->slug,
            '{day}' => $this->created_at->format('d'),
            '{month}' => $this->created_at->format('m'),
            '{year}' => $this->created_at->format('Y')
        ];

        if (in_array($this->type, $reserve)) {
            return url('/'). str_replace(array_keys($formatter), array_values($formatter), $url);
        } else {
            return url('/').'/'. $this->type. '/'. $this->slug;
        }

    }
}
