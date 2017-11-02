<?php

namespace Story\Framework\Backend\Controllers\Settings;

use Configuration;
use Story\Framework\Backend\Controllers\Controller;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    /**
     * Display general form
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = Configuration::instance();

        return $this->view('cms::settings.general', compact('config'));
    }

    /**
     * Update general information for site
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Configuration::set('SITE_TITLE', $request->input('site_title'));
        Configuration::set('SITE_TAGLINE', $request->input('site_tagline'));
        Configuration::set('SITE_MEMBERSHIP', $request->input('site_membership'));
        Configuration::set('SITE_DATE_FORMAT', $request->input('date_format'));
        Configuration::set('SITE_TIME_FORMAT', $request->input('time_format'));

        return response()->json([
            'meta' => [
                'message' => 'Setting is updated.'
            ]
        ]);
    }
}
