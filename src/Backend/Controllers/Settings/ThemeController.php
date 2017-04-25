<?php

namespace Story\Cms\Backend\Controllers\Settings;

use Story\Cms\Backend\Controllers\Controller;

class ThemeController extends Controller
{
    public function index()
    {
        return $this->view('settings.theme.index');
    }
}
