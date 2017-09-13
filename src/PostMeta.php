<?php

namespace Story\Cms;

use Story\Cms\Contracts\StoryPostmeta;

class PostMeta extends Model implements StoryPostmeta
{
    protected $table = 'posts_metas';
    protected $fillable = ['post_id', 'name', 'value'];

    public $timestamps = false;
}
