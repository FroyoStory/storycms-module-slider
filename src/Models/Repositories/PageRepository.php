<?php

namespace Story\Cms\Models\Repositories;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Story\Cms\Models\Post;

class PageRepository
{
    public function all()
    {
        return Post::where('type', Post::PAGE)->get();
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
                    'meta_title' => $request->input('meta_title'),
                    'meta_description' => $request->input('meta_description'),
                    'meta_keyword' => $request->input('meta_keyword'),
                ];
            }
        }

        $post = Post::create(
            array_merge($data, [
                'type' => 'PAGE',
                'status' => $request->input('status'),
                'user_id' => Auth::user()->id,
                'category_id' => 1
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

    public function findBySlug($slug)
    {
        return Post::where('type', 'PAGE')
            ->where('status', 'PUBLISHED')
            ->whereHas('translations', function($query) use ($slug) {
                $query->where('locale', App::getLocale());
                $query->where('slug', $slug);
            })->firstOrFail();
    }

    public function update(Post $post, Request $request)
    {
        $locale = $request->input('locale');

        $post->status = $request->input('status');
        $post->user_id = Auth::user()->id;

        $post->translate($locale)->title = $request->input('title');
        $post->translate($locale)->body = $request->input('body');
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
}
