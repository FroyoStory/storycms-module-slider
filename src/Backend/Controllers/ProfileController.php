<?php

namespace Story\Cms\Backend\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Story\Cms\Contracts\StoryUserRepository;

class ProfileController extends Controller
{
    /**
     * The StoryUserRepository implementation.
     *
     * @var Story\Cms\Contracts\StoryUserRepository
     */
    protected $user;

    /**
     * Create new controller.
     *
     * @param StoryUserRepository $user
     */
    public function __construct(StoryUserRepository $user)
    {
        $this->user  = $user;
    }

    /**
     * Display user that currently login
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $profile  = $request->user();

        return $this->view('cms::users.profile', compact('profile'));
    }

    /**
     * Update current user
     *
     * @param  Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Request
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|alpha_num',
            'confirm_password' => 'required_with:password|alpha_num|same:password'
        ]);

        if ($request->input('password') == '') {
            $data = $request->only('name', 'email', 'id');
        } else {
            $data = $request->only('name', 'email', 'password', 'id');
        }

        if ($user = $this->user->findById($data['id'])) {
            $user = $this->user->update($user, $data);
            if (!$user) {
                return response()->json([
                    'meta' => ['message' => 'Unable to update user']
                ], 422);
            }
            return response()->json([
                'data' => $user,
                'meta' => ['message' => 'User was updated']
            ]);
        }
        return response()->json([
            'data' => [],
            'meta' => ['message' => 'Unable to find user']
        ], 422);
    }

}
