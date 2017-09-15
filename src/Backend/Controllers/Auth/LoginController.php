<?php

namespace Story\Cms\Backend\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Story\Cms\Backend\Controllers\Controller;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('cms::auth.login');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if ($request->ajax()) {

        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Redirect after login successfull
     *
     * @return \Illuminate\Http\Response
     */
    protected function redirectTo()
    {
        return redirect()->to('/backend/');
    }
}
