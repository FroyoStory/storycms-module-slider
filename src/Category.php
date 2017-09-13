<?php

namespace Story\Cms;

use Story\Cms\Contracts\StoryCategory;
use Themsaid\Multilingual\Translatable;

class Category extends Model implements StoryCategory
{
    use Translatable;

    protected $table = 'categories';
    protected $fillable = ['name', 'slug', 'parent_id', 'description'];

    public $translatable = ['name', 'description'];
    public $casts = ['name' => 'array', 'description' => 'array'];
    public $describes = [
        'name' => ['label' => 'Category name', 'lang' => true, 'validation' => 'required|unique:categories'],
        'slug' => ['label' => 'Slug', 'validation' => 'required|unique:categories'],
        'parent_id' => ['label' => 'Parent category', 'validation' => 'exists:categories,parent_id'],
        'description' => ['label' => 'Category description', 'lang' => true]
    ];

    /**
     * The post relationship
     *
     * @return \Illuminate\Database\Eloquent\Collections
     */
    public function post()
    {
        return $this->belongsToMany(
            resolve(Contracts\StoryPost::class),
            'posts_categories', 'category_id', 'post_id'
        );
    }
}
