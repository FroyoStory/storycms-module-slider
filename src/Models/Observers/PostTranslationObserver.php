<?php

namespace Story\Cms\Models\Observers;

use Story\Cms\Models\Translatable\PostTranslation;
use Illuminate\Support\Str;

class PostTranslationObserver
{
    public function saving(PostTranslation $post)
    {
        if (!$post->slug) {
            $post->slug = Str::slug($post->title);
        } else {
            $post->slug = Str::slug($post->slug);
        }
    }
}
