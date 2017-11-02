<?php

namespace Story\Framework;

use Story\Framework\Contracts\StoryPostmeta;

class PostMeta extends Model implements StoryPostmeta
{
    protected $table = 'posts_metas';
    protected $fillable = ['post_id', 'name', 'value'];

    public $timestamps = false;
}
