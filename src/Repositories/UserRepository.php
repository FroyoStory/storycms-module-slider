<?php

namespace Story\Cms\Repositories;

use Story\Cms\Contracts\StoryUserRepository;
use Story\Cms\Contracts\StoryUser;

class UserRepository extends Repository implements StoryUserRepository
{
    /**
     * THe StoryUser implmentation.
     *
     * @var Story\Cms\Contracts\StoryUser
     */
    protected $users;

    /**
     * Create new user repository intance
     *
     * @param StoryUser $users
     */
    public function __construct(StoryUser $users)
    {
        $this->users = $users;
    }

    /**
     * Display users list using pagination
     *
     * @return array
     */
    public function paginate()
    {
        $users = $this->users->paginate();
        return $this->paginator($users);
    }

    /**
     * Create a new user
     *
     * @param  array  $data [description]
     * @return false|\Story\Cms\Contracts\StoryUser
     */
    public function create(array $data)
    {
        $user = $this->users->create($data);

        if ($user) {
            //@TODO call event user was created
            return $user;
        }
        return false;
    }

    /**
     * Find user by id
     *
     * @param  int    $id
     * @return \Story\Cms\Contracts\StoryUser
     */
    public function findById(int $id)
    {
        return $this->users->find($id);
    }

    /**
     * Find user email
     *
     * @param  string $email
     * @return \Story\Cms\Contracts\StoryUser
     */
    public function findByEmail(string $email)
    {
        return $this->users->where('email', $email)->first();
    }

    /**
     * Update the user data by given id
     *
     * @param  StoryUser $user
     * @param  array    $data
     * @return false|\Story\Cms\Contracts\StoryUser
     */
    public function update(StoryUser $user, array $data)
    {
        foreach ($data as $key => $value) {
            $user->{$key} = $value;
        }

        if ($user->save()) {
            //@TODO create event update user
            return $user;
        }
        return false;
    }

    /**
     * Destroy the user by given id
     *
     * @param  StoryUser $user
     * @return bool
     */
    public function destroy(StoryUser $user)
    {
        return $user->delete();
    }
}
