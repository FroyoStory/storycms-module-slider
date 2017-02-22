<?php

namespace Story\Cms;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\AliasLoader;

class StoryCmsServiceProvider extends ServiceProvider
{

    protected $namespace = 'Story\\Cms';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([ __DIR__.'/../config/cms.php' => config_path('cms.php')]);
        $this->loadViewsFrom(__DIR__.'/../views', 'cms');

        $this->registerServices();
    }

    /**
     * Register custom service provider
     *
     * @return void
     */
    protected function registerServices()
    {
        $loader = AliasLoader::getInstance();

        if (env('APP_ENV') !== 'production') {

        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(__DIR__.'/../routes/web.php');

        Route::group(
            ['prefix' => 'backend', 'middleware' => ['web'], 'namespace' => $this->namespace . '\\Backend\\Controllers'], function() {
            require __DIR__.'/../routes/backend.php';
        });
    }

    /**
     * Get navigation config for cms
     *
     * @return array
     */
    public static function navigation()
    {
        return [
            'backend' => [
                'cms' => [
                    'title' => 'content',
                    'groups' => [
                        'elements' => ['pages', 'posts']
                    ]
                ]
            ]
        ];

    }
}
