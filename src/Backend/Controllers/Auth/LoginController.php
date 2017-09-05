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
     * Redirect after login successfull
     *
     * @return \Illuminate\Http\Response
     */
    protected function redirectTo()
    {
        return redirect()->to('/backend/');
    }
}
