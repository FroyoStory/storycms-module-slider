<?php

namespace Story\Cms\Models\Repositories;

use Story\Cms\Models\Role;
use Illuminate\Http\Request;

class RoleRepository
{
    public function all()
    {
        return Role::paginate();
    }

    public function create(Request $request)
    {
        $role = Role::create(['name' => $request->input('name')]);

        if ($role) {
            event(new \Story\Cms\Events\RoleCreated($role, $request));
            return $role;
        }
        return false;
    }

    public function findById($id)
    {
        return Role::findOrFail($id);
    }

    public function update(Role $role, $request)
    {
        $role->name = $request->input('name');

        if ($role->save()) {
            event(new \Story\Cms\Events\RoleUpdated($role, $request));
            return $role;
        }
        return false;
    }
}
