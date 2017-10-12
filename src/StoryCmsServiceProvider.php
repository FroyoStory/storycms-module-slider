<?php

namespace Story\Cms;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\AliasLoader;

class StoryCmsServiceProvider extends ServiceProvider
{

    /**
     * The story cms class namespace
     *
     * @var string
     */
    protected $namespace = 'Story\\Cms';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerRoutes();
        $this->registerResources();
        $this->registerMigrations();
        $this->defineAssetPublishing();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->configure();
        $this->registerServices();
        $this->registerAliases();
        $this->registerPlugins();
    }

    /**
     * Define the asset publishing configuration.
     *
     * @return void
     */
    public function defineAssetPublishing()
    {
        $this->publishes([
            __DIR__.'/../public/css' => public_path('vendor/storycms/css'),
            __DIR__.'/../public/js' => public_path('vendor/storycms/js'),
            __DIR__.'/../public/images' => public_path('vendor/storycms/images'),
            __DIR__.'/../public/mix-manifest.json' => public_path('vendor/storycms/mix-manifest.json'),
            __DIR__.'/../public/fonts' => base_path('public/fonts'),
        ], 'storycms');
    }

    /**
     * Register the CMS migrations
     *
     * @return void
     */
    public function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Register resources CMS
     *
     * @return void
     */
    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'cms');

        // Register plugins views
        if (file_exists(config()->get('cms.plugin_path'))) {
            $files = File::getRequire(config()->get('cms.plugin_path'));
            foreach ($files['name'] as $name) {
                if (is_dir(base_path('plugins').'/'. $name.'/resources/views')) {
                    $this->loadViewsFrom(base_path('plugins').'/'. $name.'/resources/views', $name);
                }
            }
        }

        // Register theme views
        $this->loadViewsFrom(public_path().'/themes', 'theme');
    }

    /**
     * Register routes CMS
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::group(['prefix' => 'backend'], function() {
            Route::middleware('web')
                ->namespace($this->namespace . '\\Backend\\Controllers')
                ->group(__DIR__.'/../routes/backend.php');
        });

        if (config()->get('cms.route') === true) {
            Route::middleware('web')
                ->namespace($this->namespace . '\\Frontend\\Controllers')
                ->group(__DIR__.'/../routes/web.php');
        }
    }

    /**
     * Configure CMS
     *
     * @return void
     */
    protected function configure()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/cms.php', 'cms');
        $this->mergeConfigFrom(__DIR__.'/../config/mapping.php', 'mapping');
        $this->mergeConfigFrom(__DIR__.'/../config/navigation.php', 'navigation');
        $this->mergeConfigFrom(__DIR__.'/../config/multilangual.php', 'multilangual');
        $this->mergeConfigFrom(__DIR__.'/../config/scout.php', 'scout');
    }

    /**
     * Register custom service provider
     *
     * @return void
     */
    protected function registerServices()
    {
        $this->app->register(Config\ConfigServiceProvider::class);
        $this->app->register(Providers\BladeServiceProvider::class);
        $this->app->register(Providers\SocialServiceProvider::class);

        $this->app->register(\Intervention\Image\ImageServiceProvider::class);
        $this->app->register(\Jenssegers\Date\DateServiceProvider::class);
        $this->app->register(\Cartalyst\Tags\TagsServiceProvider::class);
        $this->app->register(\Laravel\Scout\ScoutServiceProvider::class);
        $this->app->register(\TeamTNT\Scout\TNTSearchScoutServiceProvider::class);
        $this->app->register(\Themsaid\Multilingual\MultilingualServiceProvider::class);

        // Register core service bindings
        foreach (config('mapping') as $key => $value) {
            is_numeric($key) ? $this->app->singleton($value) : $this->app->singleton($key, $value);
        }
    }

    /**
     * Register installed plugins
     *
     * @return void
     */
    protected function registerPlugins()
    {
        if (file_exists(config()->get('cms.plugin_path'))) {
            $files = File::getRequire(config()->get('cms.plugin_path'));
            foreach ($files['providers'] as $key => $class) {
                if (class_exists($class)) {
                    $this->app->register($class);
                }
            }
        }
    }

    /**
     * Register custom alias
     *
     * @return void
     */
    protected function registerAliases()
    {
        $loader = AliasLoader::getInstance();

        $loader->alias('Configuration', \Story\Cms\Support\Facades\Configuration::class);
        $loader->alias('Plugin', \Story\Cms\Support\Facades\Plugin::class);
        $loader->alias('SEO', \Story\Cms\Support\Facades\SEO::class);
        $loader->alias('Theme', \Story\Cms\Support\Facades\Theme::class);
    }
}
