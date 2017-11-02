<?php

namespace Story\Framework\Config;

use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('configuration', function() {
            return new ConfigManager(Config::all()->toArray());
        });
    }
}
