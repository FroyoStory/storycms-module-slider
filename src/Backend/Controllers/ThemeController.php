<?php

namespace Story\Cms\Backend\Controllers;

class ThemeController extends Controller
{
    public function index()
    {
        return $this->view('themes.index');
    }
}
