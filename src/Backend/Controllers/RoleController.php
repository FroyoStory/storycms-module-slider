<?php

namespace Story\Cms\Backend\Controllers;

use Illuminate\Http\Request;
use Story\Cms\Contracts\StoryRoleRepository;

class RoleController extends Controller
{
    /**
     * The StoryRoleRepository implementation.
     *
     * @var Story\Cms\Contracts\StoryRoleRepository
     */
    protected $roles;

    /**
     * Create a new role controller instance.
     *
     * @param StoryRoleRepository $roles
     */
    public function __construct(StoryRoleRepository $roles)
    {
        $this->roles = $roles;
    }

    /**
     * Display all available roles
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roles->paginate();

        return $this->view('cms::role.index', compact('roles'));
    }

    /**
     * Create a new role
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name'
        ]);

        $role = $this->roles->create($request->only('name', 'description'));

        if ($role) {
            return response()->json([
                'data' => $role,
                'meta' => ['message' => 'Role was created']
            ]);
        }
        return response()->json([
            'meta' => ['message' => 'Unable to create role']
        ], 422);
    }

    /**
     * Update a role by given id
     *
     * @param  Request $request
     * @param  int     $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $role = $this->roles->findById($id);
        $role = $this->roles->update($role, $request->only('name', 'description'));

        if ($role) {
            return response()->json([
                'data' => $role,
                'meta' => ['message' => 'Role was updated']
            ]);
        }

        return response()->json([
            'meta' => ['message' => 'Unable to update role']
        ], 422);
    }

    /**
     * Destroy role
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $role = $this->roles->findById($id);

        if ($this->roles->destroy($role)) {
            return response()->json([
                'data' => $role,
                'meta' => ['message' => 'Role was destroyed']
            ]);
        }

        return response()->json([
            'meta' => ['message' => 'Unable to destroy role']
        ], 422);
    }
}
