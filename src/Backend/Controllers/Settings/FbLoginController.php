<?php

namespace Story\Cms\Backend\Controllers\Settings;

use Illuminate\Http\Request;
use Story\Cms\Backend\Controllers\Controller;
use Story\Cms\Support\Social\FacebookSupport;
use Configuration;
use Laravel\Socialite\Facades\Socialite as Socialite;


class FbLoginController extends Controller
{
    protected $fb;

    public function __construct(FacebookSupport $facebook)
    {
        $this->fb = $facebook;
    }


    public function index()
    {
        if (Configuration::instance()->FB_APP_ID != '' && Configuration::instance()->FB_APP_SECRET != '' && Configuration::instance()->FB_APP_REDIRECT != '') {
            return Socialite::driver('facebook')->scopes(['publish_pages', 'manage_pages'])->redirect();
        } else {
            return back();
        }
    }

    public function callback(Request $request)
    {
        if(!$request->input('error')) {
            $user = Socialite::driver('facebook')->user();
            Configuration::set('FB_ACCESS_TOKEN', $user->token);
        }
        return redirect()->route('social.index');
    }
}
