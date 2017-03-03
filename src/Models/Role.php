<?php

namespace Story\Cms\Models;

use Story\Core\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['name'];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
