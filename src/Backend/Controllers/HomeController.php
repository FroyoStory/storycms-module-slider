<?php

namespace Story\Cms\Backend\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('cms::backend.dashboard');
    }
}
