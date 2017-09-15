<?php

namespace Story\Cms\Backend\Controllers;

use Plugin;

class PluginController extends Controller
{
    public function index()
    {
        $plugins = Plugin::all();

        return $this->view('cms::plugin.index', compact('plugins'));
    }

    public function store()
    {

    }

    public function destroy()
    {

    }
}
