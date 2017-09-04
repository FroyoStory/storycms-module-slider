<?php

namespace Story\Cms\Repositories;

use Story\Cms\Contracts\StoryUserRepository;
use Story\Cms\Contracts\StoryUser;

class UserRepository implements StoryUserRepository
{
    protected $users;

    public function __construct(StoryUser $users)
    {
        $this->users = $users;
    }

    public function paginate()
    {
        return $this->users->paginate();
    }
}
