<?php

namespace Story\Cms\Backend\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests, AuthorizesRequests;

    protected $module = 'cms::backend';

    /**
     * Render view response
     *
     * @param  string $page
     * @param  array  $data
     * @return \Illuminate\Http\Response
     */
    public function view($page, array $data = [])
    {
        return view($page, $data);
    }
}
