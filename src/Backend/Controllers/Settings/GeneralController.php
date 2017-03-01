<?php

namespace Story\Cms\Backend\Controllers\Settings;

use Story\Cms\Backend\Controllers\Controller;

class GeneralController extends Controller
{
    public function index()
    {
        return $this->view('settings.general');
    }

    public function store()
    {

    }
}
