<?php

namespace Story\Framework\Backend\Controllers;

use Illuminate\Http\Request;
use Story\Framework\Repositories\UserRepository;
use Story\Framework\Repositories\RoleRepository;

class UserController extends Controller
{
    /**
     * The UserRepository implementation.
     *
     * @var \Story\Framework\Repositories\UserRepository
     */
    protected $user;

    /**
     * The RoleRepository implementation.
     *
     * @var Story\Framework\Repositories\RoleRepository
     */
    protected $roles;

    /**
     * Create a controller instance
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user, RoleRepository $roles)
    {
        $this->user = $user;
        $this->roles = $roles;
    }

    /**
     * Display all user data
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->paginate();
        $roles = $this->roles->all();

        return $this->view('cms::users.index', compact('users', 'roles'));
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
            'role_id' => 'required|exists:roles,id'
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

    /**
     * Update user data by user given id
     *
     * @param  Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|alpha_num|min:5',
            'confirm_password' => 'same:password',
            'role_id' => 'required|exists:roles,id'
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

    /**
     * Destroy a user by given id
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $user = $this->user->findById($id);

        if ($this->user->destroy($user)) {
            return response()->json([
                'data' => $user,
                'meta' => ['message' => 'User was destroyed']
            ]);
        }

        return response()->json([
            'meta' => ['message' => 'Unable to destroy user']
        ], 422);
    }
}
