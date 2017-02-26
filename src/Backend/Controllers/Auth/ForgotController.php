<?php

namespace Story\Cms\Backend\Controllers\Auth;

use Story\Cms\Backend\Controllers\Controller;

class ForgotController extends Controller
{
    public function index()
    {
        return $this->view('auth.forgot');
    }

    public function store()
    {

    }
}
