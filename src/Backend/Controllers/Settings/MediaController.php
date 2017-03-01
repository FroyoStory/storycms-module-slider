<?php

namespace Story\Cms\Backend\Controllers\Settings;

use Story\Cms\Backend\Controllers\Controller;

class MediaController extends Controller
{
    public function index()
    {
        return $this->view('settings.media');
    }

    public function store()
    {

    }
}
