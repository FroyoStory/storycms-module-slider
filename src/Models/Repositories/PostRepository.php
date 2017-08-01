<?php

namespace Story\Cms\Models\Repositories;

use Story\Cms\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostRepository
{
    public function all()
    {
        return Post::where('type', Post::POST)->paginate();
    }

    public function create(Request $request)
    {
        $locales = config()->get('translatable.locales');
        $data = [];

        if ($request->input('locales')) {
            foreach ($request->input('locales') as $key => $locale) {
                $data[$key] = $locale;
            }
        } else {
            foreach ($locales as $locale) {
                $data[$locale] = [
                    'title' => $request->input('title'),
                    'body' => $request->input('body'),
                    'excerpt' => $request->input('excerpt'),
                    'meta_title' => $request->input('meta_title'),
                    'meta_description' => $request->input('meta_description'),
                    'meta_keyword' => $request->input('meta_keyword'),
                ];
            }
        }

        $post = Post::create(
            array_merge($data, [
                'type' => 'POST',
                'slug' => Str::slug($request->input('title')),
                'status' => $request->input('status'),
                'user_id' => Auth::user()->id,
                'category_id' => $request->input('category_id')
            ])
        );

        if ($post) {
            MediaRepository::store($post, $request);
            event(new \Story\Cms\Events\PostCreated($post, $request));
            return $post;
        }

        return false;
    }

    public function findById($id)
    {
        return Post::findOrFail($id);
    }

    public function update(Post $post, Request $request)
    {
        $locale = $request->input('locale');

        $post->status = $request->input('status');
        $post->slug = Str::slug($request->input('slug'));
        $post->category_id = $request->input('category_id');
        $post->user_id = Auth::user()->id;

        $post->translate($locale)->title = $request->input('title');
        $post->translate($locale)->body = $request->input('body');
        $post->translate($locale)->excerpt = $request->input('excerpt');
        $post->translate($locale)->meta_title = $request->input('meta_title');
        $post->translate($locale)->meta_description = $request->input('meta_description');
        $post->translate($locale)->meta_keyword = $request->input('meta_keyword');

        if ($post->save()) {
            MediaRepository::store($post, $request);
            event(new \Story\Cms\Events\PostUpdated($post, $request));
            return $post;
        }

        return false;
    }

    public function search(Request $request)
    {
        return Post::whereHas('translations', function($query) use ($request) {
            $query->where('title', 'LIKE', '%'.$request->input('q').'%');
        })->paginate();
    }
}
