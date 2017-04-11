<?php

namespace Story\Cms\Models;

use Story\Core\Model;

class Media extends Model
{
    protected $table = 'posts_media';
    protected $fillable = ['post_id', 'name', 'url', 'type'];
}
