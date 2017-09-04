<?php

namespace Story\Cms;

// use Story\Core\Tabs\Tab;
// use Story\Core\Plugins;
use Story\Cms\Contracts\PluginInterface;
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
        $this->registerRoutes();
        $this->registerResources();
        $this->registerMigrations();
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
     * @return void
     */
    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'cms');
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
                ->namespace($this->namespace . '\\Backend\\Controllers\\')
                ->group(__DIR__.'/../routes/backend.php');
        });
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
    }

    /**
     * Register custom service provider
     *
     * @return void
     */
    protected function registerServices()
    {
        $this->app->register(\Themsaid\Multilingual\MultilingualServiceProvider::class);

        // Register core service bindings
        foreach (config('mapping') as $key => $value) {
            // is_numeric($key) ? $this->app->singleton($value) :
            $this->app->singleton($key, $value);
        }
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

    /**
     * Hook the post editor
     *
     * @param  Array|array $data
     * @return array
     */
    public static function hook(Array $data = [])
    {
        // return [
        //     'backend' => [
        //         'page-editor' => [
        //             (new Tab('Media Assets', 'cms::addons.media', $data))->display(),
        //         ],
        //         'post-editor' => [
        //             (new Tab('Media Assets', 'cms::addons.media', $data))->display(),
        //         ]
        //     ]
        // ];
    }
}
