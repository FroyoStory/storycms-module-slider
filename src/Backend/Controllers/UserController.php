<?php

namespace Story\Cms\Backend\Controllers;

use Illuminate\Http\Request;
use Story\Cms\Repositories\UserRepository;
use Story\Cms\Models\Repositories\RoleRepository;

class UserController extends Controller
{
    /**
     * The UserRepository implementation.
     *
     * @var \Story\Cms\Repositories\UserRepository
     */
    protected $user;

    /**
     * Create a controller instance
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * Display all user data
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->paginate();
        return $this->view('cms::users.index', compact('users'));
    }

    /**
     * Create a new user
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|alpha_num|min:5',
            'confirm_password' => 'same:password',
            'role_id' => 'required'
        ]);

        $user = $this->user->create($request->only('name', 'email', 'password', 'role_id'));

        if ($user) {
            return response()->json([
                'data' => $user,
                'meta' => ['message' => 'User was created']
            ]);
        }
        return response()->json([
            'meta' => ['message' => 'Unable to create user']
        ], 422);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|alpha_num|min:5',
            'confirm_password' => 'same:password',
            'role_id' => 'required'
        ]);

        $user = $this->user->findById($id);
        $user = $this->user->update($user, $request->only('name', 'email', 'password'));

        if ($user) {
            return response()->json([
                'data' => $user,
                'meta' => ['message' => 'User was updated']
            ]);
        }

        return response()->json([
            'meta' => ['message' => 'Unable to update user']
        ], 422);
    }

    public function destroy($id)
    {
        $user = $this->user->findById($id);

        if ($this->user->destroy($user)) {
            return response()->json([
                'meta' => ['message' => 'User was destroyed']
            ]);
        }

        return response()->json([
            'meta' => ['message' => 'Unable to destroy user']
        ], 422);
    }
}
