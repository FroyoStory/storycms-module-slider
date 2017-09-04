<?php

namespace Story\Cms\Backend\Controllers;

use Illuminate\Http\Request;
use Story\Cms\Repositories\UserRepository;
use Story\Cms\Models\Repositories\RoleRepository;
use Story\Cms\Backend\Requests\MemberRequest;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $users = $this->user->paginate();

        return $this->view('cms::users.index', compact('users'));
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
        $user = $this->user->delete($id);

        if(!$user) {
            session()->flash('message', 'Unable to delete user');
        } else {
            session()->flash('info', 'User was deleted');
        }

        return redirect()->back();
    }
}
