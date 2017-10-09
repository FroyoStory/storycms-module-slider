<?php

namespace Story\Cms\Backend\Controllers\Settings;

use Configuration;
use Story\Cms\Backend\Controllers\Controller;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    /**
     * Display social form
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = Configuration::instance();

        return $this->view('cms::settings.social', compact('config'));
    }

    /**
     * Update social information for site
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->input('switch') == 1) {
            Configuration::set('SITE_TITLE', $request->input('site_title'));
            Configuration::set('FB_APP_ID', $request->input('fb_app_id'));
            Configuration::set('FB_APP_SECRET', $request->input('fb_app_secret'));
            Configuration::set('FB_ACCESS_TOKEN', $request->input('fb_access_token'));
            Configuration::set('TW_ACCESS_TOKEN', $request->input('tw_access_token'));
            Configuration::set('TW_ACCESS_TOKEN_SECRET', $request->input('tw_access_token_secret'));
            Configuration::set('TW_CONSUMER_KEY', $request->input('tw_consumer_key'));
            Configuration::set('TW_CONSUMER_SECRET', $request->input('tw_consumer_secret'));
            Configuration::set('INSTA_USERNAME', $request->input('insta_username'));
            Configuration::set('INSTA_PASSWORD', $request->input('insta_password'));
        }

        Configuration::set('switch', $request->input('switch'));

        return response()->json([
            'meta' => [
                'message' => 'Setting is updated.'
            ]
        ]);
    }
}
