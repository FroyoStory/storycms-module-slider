<?php

namespace Story\Cms\Backend\Controllers\Auth;

use Story\Cms\Backend\Controllers\Controller;

class LoginController extends Controller
{
    public function index()
    {
        return $this->view('auth.login');
    }

    public function store()
    {

    }
}
