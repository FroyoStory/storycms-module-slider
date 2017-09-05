<?php

namespace Story\Cms;

use Story\Cms\Contracts\StoryUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements StoryUser
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
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
     * Get role relationship
     *
     * @return Story\Cms\Contracts\StoryRole
     */
    public function role()
    {
        return $this->belongsTo(resolve(Contracts\StoryRole::class));
    }
}
