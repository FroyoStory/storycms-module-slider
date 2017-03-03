<?php

namespace Story\Cms\Backend\Controllers;

use Story\Cms\Backend\Requests\RoleRequest;
use Story\Cms\Models\Repositories\RoleRepository;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $roles;

    public function __construct(RoleRepository $roles)
    {
        $this->roles = $roles;
    }

    public function index()
    {
        $this->data['roles'] = $this->roles->all();

        return $this->view('role.index');
    }

    public function store(RoleRequest $request)
    {
        $roles = $this->roles->create($request);

        if ($roles) {
            session()->flash('info', 'Role is created');
        } else {
            session()->flash('message', 'Unable to create roles');
        }

        return redirect()->back();
    }

    public function edit($id)
    {
        $this->data['role'] = $this->roles->findById($id);

        return $this->view('role.edit');
    }

    public function update(RoleRequest $request, $id)
    {
        $role = $this->roles->findById($id);
        $role = $this->roles->update($role, $request);

        if ($role) {
            session()->flash('info', 'Role is updated');
        } else {
            session()->flash('message', 'Unable to updated roles');
        }

        return redirect()->back();
    }

    public function destroy($id)
    {

    }
}
