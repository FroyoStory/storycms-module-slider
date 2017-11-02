<?php

namespace Story\Framework\Repositories;

use Story\Framework\Contracts\StoryCategory;
use Story\Framework\Contracts\StoryCategoryRepository;

class CategoryRepository extends Repository implements StoryCategoryRepository
{
    /**
     * The StoryCategory model implementation.
     *
     * @var Story\Framework\Contracts\StoryCategory
     */
    protected $category;

    /**
     * Create story category repository
     *
     * @param StoryCategory $category
     */
    public function __construct(StoryCategory $category)
    {
        $this->category = $category;
    }

    /**
     * Fetch all categories from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->category->all();
    }

    /**
     * Build tree from categories data
     *
     * @return \Kalnoy\Nestedset\Collection
     */
    public function toTree()
    {
        return array_first($this->category->defaultOrder()->get()->toTree())->children;
    }

    /**
     * Rebuild tree data by given categories collection
     *
     * @param  array  $data
     * @return \Kalnoy\Nestedset\Collection
     */
    public function rebuildTree(array $data)
    {
        $root = $this->findById(1);
        return $this->category->rebuildSubtree($root, $data['categories']);
    }

    /**
     * Save a category base on data
     *
     * @param  array $data
     * @return \Story\Cms\Contracts\StoryCategory
     */
    public function create(array $data)
    {
        return $this->category->create($data);
    }

    /**
     * Find category by id
     *
     * @param  int $id
     * @return \Story\Cms\Contracts\StoryCategory
     */
    public function findById(int $id)
    {
        return $this->category->find($id);
    }

    /**
     * Find category by slug
     *
     * @param  string $slug
     * @return \Story\Cms\Contracts\StoryCategory
     */
    public function findBySlug(string $slug)
    {
        return $this->category->where('slug', $slug)->first();
    }

    /**
     * Update a category by given category Id
     *
     * @param  StoryCategory $category
     * @param  array         $data
     * @return false|\Story\Cms\Contracts\StoryCategory
     */
    public function update(StoryCategory $category, array $data)
    {
        foreach ($data as $key => $value) {
            $category->{$key} = $value;
        }

        if ($category->save()) {
            return $category;
        }
        return false;
    }

    /**
     * Destroy a category by given id
     *
     * @param  StoryCategory $category
     * @return bool
     */
    public function destroy(StoryCategory $category)
    {
        return $category->delete();
    }
}
