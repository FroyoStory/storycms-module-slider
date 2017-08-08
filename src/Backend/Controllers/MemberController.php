<?php

namespace Story\Cms\Backend\Controllers;

use Illuminate\Http\Request;
use Story\Cms\Models\Repositories\MemberRepository;
use Story\Cms\Models\Repositories\RoleRepository;
use Story\Cms\Backend\Requests\MemberRequest;

class MemberController extends Controller
{
    protected $user;

    public function __construct(MemberRepository $user, RoleRepository $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function index()
    {
        $this->data['users'] = $this->user->all();

        return $this->view('member.index');
    }

    public function create()
    {
        $this->data['roles']      = $role;

        return $this->view('member.create');
    }

    public function store(MemberRequest $request)
    {
        $user = $this->user->create($request);

        if (!$user) {
            session()->flash('message', 'Unable to create user');
        } else {
            session()->flash('info', 'User was created');
        }

        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        $user = $this->user->findById($id);
        $role = $this->role->all();

        $this->data['user']       = $user;
        $this->data['roles']      = $role;

         return $this->view('member.edit');
    }

    public function update(MemberRequest $request, $id)
    {
        $user = $this->user->findById($id);
        $update_user = $this->user->update($user, $request);

        if (!$update_user) {
            session()->flash('message', 'Unable to update user');
        } else {
            session()->flash('info', 'User was updated');
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $user = $this->user->findById($id);
        $delete = $this->user->delete($user);

        if(!$delete) {
            session()->flash('message', 'Unable to delete user');
        } else {
            session()->flash('info', 'User was deleted');
        }

        return redirect()->back();
    }
}
