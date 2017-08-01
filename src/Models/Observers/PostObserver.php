<?php

namespace Story\Cms\Models\Observers;

use Story\Cms\Models\Post;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PostObserver
{
    public function saving(Post $post)
    {
        if ($post->status == Post::PUBLISHED) {
            $post->published_at = Carbon::now();
        }
    }
}
