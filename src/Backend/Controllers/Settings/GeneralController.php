<?php

namespace Story\Cms\Backend\Controllers\Settings;

use Configuration;
use Story\Cms\Backend\Controllers\Controller;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function index()
    {
        return $this->view('settings.general');
    }

    public function store(Request $request)
    {
        Configuration::set('site_title', $request->input('site_title'));
        Configuration::set('site_tagline', $request->input('site_tagline'));
        Configuration::set('site_membership', $request->input('site_membership'));
        Configuration::set('site_default_role', $request->input('site_default_role'));

        session()->flash('info', 'Settings is updated');

        return redirect()->back();
    }
}
