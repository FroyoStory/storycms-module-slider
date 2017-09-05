<?php

namespace Story\Cms;

use Story\Cms\Contracts\StoryRole;
use Illuminate\Database\Eloquent\Model;

class Role extends Model implements StoryRole
{
    protected $table = 'roles';
    protected $fillable = ['name', 'description'];

    /**
     * Get user relationship
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function user()
    {
        return $this->hasMany(resolve(Contracts\StoryUser::class));
    }
}
