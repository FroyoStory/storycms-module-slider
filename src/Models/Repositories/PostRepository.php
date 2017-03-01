<?php

namespace Story\Cms\Models\Repositories;

use Story\Cms\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostRepository
{
    public function get()
    {
        return Post::paginate();
    }

    public function create(Request $request)
    {
        return Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
            'meta_keyword' => $request->input('meta_keyword'),

            'type' => 'POST',
            'status' => $request->input('status'),
            'user_id' => 1,
            'category_id' => $request->input('category_id')
        ]);
    }
}
