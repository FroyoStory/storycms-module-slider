<?php

namespace Story\Cms\Models\Observers;

use Story\Cms\Models\Translatable\CategoryTranslation;
use Illuminate\Support\Str;

class CategoryTranslationObserver
{
    public function saving(CategoryTranslation $category)
    {
        if (!$category->slug) {
            $category->slug = Str::slug($category->name);
        } else {
            $category->slug = Str::slug($category->slug);
        }
    }
}
