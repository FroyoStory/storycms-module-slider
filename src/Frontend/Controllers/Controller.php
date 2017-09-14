<?php

namespace Story\Cms\Frontend\Controllers;

use Configuration;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    /**
     * Helper function frontend
     *
     * @param  string $name
     * @param  array  $data
     * @return \Illuminate\Http\Reponse
     */
    public function view($name, array $data = [])
    {
        $theme = Configuration::instance()->THEME;

        return view('theme::'. $theme.'.'. $name, $data);
    }
}
