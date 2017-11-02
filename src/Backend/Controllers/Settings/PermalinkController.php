<?php

namespace Story\Framework\Backend\Controllers\Settings;

use Configuration;
use Story\Framework\Backend\Controllers\Controller;
use Illuminate\Http\Request;

class PermalinkController extends Controller
{
    /**
     * Display general form
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = Configuration::instance();

        return $this->view('cms::settings.permalink', compact('config'));
    }

    /**
     * Update media information for site
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Configuration::set('SITE_PERMALINK', $request->input('site_permalink'));

        return response()->json([
            'meta' => [
                'message' => 'Setting is updated.'
            ]
        ]);
    }
}
