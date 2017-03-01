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
        $this->loadMigrationsFrom(__DIR__.'/../migrations');

        $this->registerServices();
    }

    /**
     * Register custom service provider
     *
     * @return void
     */
    protected function registerServices()
    {
        $this->app->register(\Story\Core\CoreServiceProvider::class);
        $this->app->register(\Story\Theme\ThemeServiceProvider::class);
        $this->app->register(\Dimsav\Translatable\TranslatableServiceProvider::class);

        $loader = AliasLoader::getInstance();

        if (env('APP_ENV') !== 'production') {
            $loader->alias('Configuration', \Story\Models\Configuration::class);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/cms.php', 'cms');

        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__.'/../routes/web.php');

        Route::group(['prefix' => 'backend'], function() {
            Route::middleware('web')
                ->namespace($this->namespace . '\\Backend\\Controllers')
                ->group(__DIR__.'/../routes/backend.php');
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
                'dashboard' => [
                    'title' => 'Dashboard',
                    'font' => 'dashboard'
                ],
                'cms' => [
                    'title' => 'Content',
                    'font'  => 'chrome_reader_mode',
                    'groups' => [
                        'elements' => ['category','pages', 'post'],
                        // 'navigations' => ['navigation']
                    ]
                ],
                'user' => [
                    'title' => 'Member',
                    'font'  => 'people',
                    'groups' => [
                        'groups' => ['member', 'roles']
                    ]
                ],
                'system' => [
                    'title' => 'System',
                    'font'  => 'settings',
                    'groups' => [
                        'setting' => ['general']
                    ]
                ]
            ]
        ];

    }
}
