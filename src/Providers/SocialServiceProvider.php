<?php

namespace Story\Cms\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class SocialServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Event::listen('Story\Cms\Events\PostCreated', 'Story\Cms\Listeners\PostToSocial');
    }

    public function register()
    {

    }
}
