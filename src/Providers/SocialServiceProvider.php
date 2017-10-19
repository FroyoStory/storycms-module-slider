<?php

namespace Story\Cms\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use log;
use Configuration;


class SocialServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Event::listen('Story\Cms\Events\PostCreated', 'Story\Cms\Listeners\PostToSocial');
        config(['services.facebook.client_id' => (string) Configuration::instance()->FB_APP_ID]);
        config(['services.facebook.client_secret' => (string) Configuration::instance()->FB_APP_SECRET]);
        config(['services.facebook.redirect' => (string) Configuration::instance()->FB_APP_REDIRECT]);
    }

    public function register()
    {

    }
}
