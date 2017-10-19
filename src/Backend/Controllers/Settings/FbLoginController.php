<?php

namespace Story\Cms\Backend\Controllers\Settings;

use Story\Cms\Backend\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite as Socialite;
use Configuration;

class FbLoginController extends Controller
{
    public function index()
    {
        if (Configuration::instance()->FB_APP_ID != '' && Configuration::instance()->FB_APP_SECRET != '' && Configuration::instance()->FB_APP_REDIRECT != '') {
            return Socialite::driver('facebook')->scopes(['publish_actions'])->redirect();
        } else {
            return back();
        }
    }

    public function callback()
    {
        $user = Socialite::driver('facebook')->user();
        Configuration::set('FB_ACCESS_TOKEN', $user->token);
        return redirect()->route('social.index');
    }
}
