<?php

namespace Story\Framework\Backend\Controllers\Auth;

use Story\Framework\Backend\Controllers\Controller;

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
