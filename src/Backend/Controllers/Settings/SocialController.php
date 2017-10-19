<?php

namespace Story\Cms\Backend\Controllers\Settings;

use Story\Cms\Support\Social\FacebookSupport;
use Story\Cms\Backend\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Configuration;

class SocialController extends Controller
{
    public function __construct()
    {
        if(Configuration::instance()->FB_APP_REDIRECT == '') {
            Configuration::set('FB_APP_REDIRECT', url('/').'/backend/fblogin/callback');
        }
    }

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
            Configuration::set('FB_APP_ID', trim($request->input('fb_app_id')));
            Configuration::set('FB_APP_SECRET', trim($request->input('fb_app_secret')));
            Configuration::set('TW_ACCESS_TOKEN', trim($request->input('tw_access_token')));
            Configuration::set('TW_ACCESS_TOKEN_SECRET', trim($request->input('tw_access_token_secret')));
            Configuration::set('TW_CONSUMER_KEY', trim($request->input('tw_consumer_key')));
            Configuration::set('TW_CONSUMER_SECRET', trim($request->input('tw_consumer_secret')));
            Configuration::set('INSTA_USERNAME', trim($request->input('insta_username')));
            Configuration::set('INSTA_PASSWORD', trim($request->input('insta_password')));
        }

        Configuration::set('switch', $request->input('switch'));

        return response()->json([
            'meta' => [
                'message' => 'Setting is updated.'
            ]
        ]);
    }
}
