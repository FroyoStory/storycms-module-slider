<?php

namespace Story\Cms;

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
}
