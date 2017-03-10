<?php

namespace Story\Cms\Models\Repositories;

use Story\Cms\Contracts\StatsInterface;
use Story\Cms\Models\Post;

class StatsRepository implements StatsInterface
{
    /**
     * Get stats from given name
     *
     * @param  string $type
     * @return int
     */
    public function get($type)
    {
        switch ($type) {
            case 'post':
                return Post::where('type', Post::POST)->get()->count();
                break;
            case 'page':
                return Post::where('type', Post::PAGE)->get()->count();
                break;

            default:
                # code...
                break;
        }
    }
}
