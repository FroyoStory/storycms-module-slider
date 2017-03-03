<?php

namespace Story\Cms;

use Story\Core\Plugins;
use Story\Core\Contracts\PluginInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\AliasLoader;

class StoryCmsServiceProvider extends ServiceProvider implements PluginInterface
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

        $loader->alias('Configuration', \Story\Cms\Models\Configuration::class);
        $loader->alias('Menu', \Story\Cms\Models\Repositories\NavigationRepository::class);

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
     * Return the navigation menu
     *
     * @return Array
     */
    public static function navigation()
    {
        return require __DIR__ . '/../config/navigation.php';
    }
}
