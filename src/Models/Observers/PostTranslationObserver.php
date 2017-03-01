<?php

namespace Story\Cms\Models\Observers;

use Story\Cms\Models\Translatable\PostTranslation;
use Illuminate\Support\Str;

/**
 * PostTranslation Observer Lib
 *
 * This class is to handle Eloquent Model transaction
 * For more information about this class you can read in
 *
 * https://laravel.com/docs/5.3/eloquent#events
 */
class PostTranslationObserver
{

    public function creating(PostTranslation $post)
    {

    }

    public function created(PostTranslation $post)
    {

    }

    public function updating(PostTranslation $post)
    {

    }

    public function updated(PostTranslation $post)
    {

    }

    public function saving(PostTranslation $post)
    {
        if (!$post->slug) {
            $post->slug = Str::slug($post->title);
        } else {
            $post->slug = Str::slug($post->slug);
        }
    }

    public function saved(PostTranslation $post)
    {

    }

    public function deleting(PostTranslation $post)
    {

    }

    public function deleted(PostTranslation $post)
    {

    }

    public function restoring(PostTranslation $post)
    {

    }

    public function restored(PostTranslation $post)
    {

    }
}
