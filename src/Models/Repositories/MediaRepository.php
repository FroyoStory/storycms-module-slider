<?php

namespace Story\Cms\Models\Repositories;

use Illuminate\Http\Request;
use Story\Cms\Models\Post;
use Story\Cms\Models\Media;

class MediaRepository
{
    public static function store(Post $post, Request $request)
    {
        if ($request->has('media')) {
            foreach ($request->input('media') as $media) {
                @list($name, $mimes) = explode('*', $media);
                Media::firstOrCreate(
                    [
                        'type'      => $mimes,
                        'url'       => config()->get('app.url').'/photos/1/'. $name
                    ],
                    [
                        'post_id'   => $post->id,
                        'name'      => $name
                    ]
                );
            }
        }
    }
}
