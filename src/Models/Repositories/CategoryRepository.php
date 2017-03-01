<?php

namespace Story\Cms\Models\Repositories;

use Illuminate\Http\Request;
use Story\Cms\Models\Category;

class CategoryRepository
{
    public function all()
    {
        return Category::all();
    }

    public function create(Request $request)
    {
        $locales = config()->get('translatable.locales');
        $data = [];

        foreach ($locales as $locale) {
            $data[$locale] = [
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
                'description' => $request->input('description')
            ];
        }

        return Category::create(
            array_merge($data, ['parent_id' => $request->input('parent_id')])
        );
    }
}
