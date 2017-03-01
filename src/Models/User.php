<?php

namespace Story\Cms\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Check if the current user has a roles
     *
     * @param  Array|array $roles
     * @return boolean
     */
    public function hasRole(Array $roles = [])
    {
        return in_array($roles, $this->role);
    }
}
