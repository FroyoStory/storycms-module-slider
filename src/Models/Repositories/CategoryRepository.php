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

    public function findById($id)
    {
        return Category::findOrFail($id);
    }

    public function update(Category $category, Request $request)
    {
        $locale = $request->input('locale');

        $category->parent_id = $request->input('parent_id');

        $category->translate($locale)->name = $request->input('name');
        $category->translate($locale)->slug = $request->input('slug');
        $category->translate($locale)->description = $request->input('description');

        return $category->save();
    }
}
