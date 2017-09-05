<?php

namespace Story\Cms\Repositories;

use Story\Cms\Contracts\StoryRole;
use Story\Cms\Contracts\StoryRoleRepository;

class RoleRepository extends Repository implements StoryRoleRepository
{
    /**
     * The StoryRole implementation.
     *
     * @var Story\Cms\Contracts\StoryRole
     */
    protected $roles;

    /**
     * Create a new role instance.
     *
     * @param StoryRole $roles
     */
    public function __construct(StoryRole $roles)
    {
        $this->roles = $roles;
    }

    /**
     * Create a new role
     *
     * @param  array  $data
     * @return false|Story\Cms\Contracts\StoryRole
     */
    public function create(array $data)
    {
        $role = $this->roles->create($data);
        if ($role) {
            return $role;
        }
        return false;
    }

    /**
     * Paginate role data.
     *
     * @return array
     */
    public function paginate()
    {
        $roles = $this->roles->paginate();
        return $this->paginator($roles);
    }

    /**
     * Get all roles
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->roles->all();
    }

    /**
     * Find role by given id
     *
     * @param  int    $id
     * @return false|Story\Cms\Contracts\StoryRole
     */
    public function findById(int $id)
    {
        return $this->roles->find($id);
    }

    /**
     * Update role by given id
     *
     * @param  StoryRole $role
     * @param  array    $data
     * @return false|Story\Cms\Contracts\StoryRole
     */
    public function update(StoryRole $role, array $data)
    {
        foreach ($data as $key => $value) {
            if ($this->roles->getAttribute($key)) {
                $role->{$key} = $value;
            }
        }

        if ($role->save()) {
            return $role;
        }
        return false;
    }

    /**
     * Destroy a role by given id
     *
     * @return  bool
     */
    public function destroy(StoryRole $role)
    {
        return $role->delete();
    }
}
