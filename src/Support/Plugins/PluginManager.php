<?php

namespace Story\Cms\Support\Plugins;

use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Filesystem\Filesystem;

class PluginManager
{
    /**
     * The filesystem implementation.
     *
     * @var Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The plugin manifest path
     *
     * @var string
     */
    protected $manifestPath;

    /**
     * Create plugin manager
     *
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;
        $this->manifestPath = config()->get('cms.plugin_path');
    }

    /**
     * Get all local plugins
     *
     * @return void
     */
    public function all()
    {
        $paths = glob(base_path().'/plugins/*/*/composer.json');

        collect($paths)->map(function($item) {
            $plugin = json_decode(file_get_contents($item));

            // updating table plugins
            Plugin::updateOrCreate(
                ['name' => $plugin->name],
                [
                    'description' => $plugin->description,
                    'providers' => $plugin->extra->story->providers
                ]
            );
            return $plugin;
        })->values();

        return Plugin::all();
    }

    /**
     * Check plugins is active or not
     *
     * @param  string  $name
     * @return boolean
     */
    public function isActive(string $name)
    {
        $plugin = Plugin::where('name', $name)->first();
        return $plugin->status == Plugin::ACTIVE;
    }

    /**
     * Install vendor package
     *
     * @param  string $name
     * @return void
     */
    public function install($name)
    {
        $plugin = Plugin::where('name', $name)->first();

        if ($plugin && $this->validatePlugins($name)) {

            if ($this->hasMigration($name)) {
                Artisan::call('migrate', [
                    '--path' => 'plugins/'. $name .'/database/migrations/',
                    '--force' => true
                ]);
            }

            if ($plugin->install()) {
                $this->build();
                return true;
            }
        }
        return false;
    }

    /**
     * Uninstall vendor package
     *
     * @param  string $name
     * @return void
     */
    public function uninstall($name)
    {
        $plugin = Plugin::where('name', $name)->first();

        if ($plugin && $this->validatePlugins($name)) {

            if ($this->hasMigration($name)) {
                Artisan::call('migrate:rollback', [
                    '--path' => 'plugins/'. $name .'/database/migrations/',
                    '--force' => true
                ]);
            }

            if ($plugin->uninstall()) {
                $this->build();
                return true;
            }
        }
        return false;
    }

    /**
     * Build assets manifest
     *
     * @return void
     */
    public function build()
    {
        Artisan::call('optimize', ['--force' => true]);

        $plugins = Plugin::where('status', Plugin::INSTALLED)->get();

        $assets = $providers = [];
        foreach ($plugins as $plugin) {
            $assets[] = $plugin->name;
            $providers = array_merge($providers, $plugin->providers);
        }

        $assets = [
            'name' => $assets,
            'providers' => array_unique($providers)
        ];

        if ($this->manifestPath) {
            $this->write($assets);
        }
    }

    /**
     * Write manifest files
     *
     * @param  array  $manifest
     * @return void
     */
    protected function write(array $manifest)
    {
        $this->files->put(
            $this->manifestPath, '<?php return '.var_export($manifest, true).';'
        );
    }

    /**
     * Validate if plugins is exists
     *
     * @param  string $path
     * @return bool
     */
    protected function validatePlugins($path)
    {
        return file_exists(base_path('plugins') . '/'.$path . '/composer.json');
    }

    /**
     * Check if plugin have migrations
     *
     * @param  string  $path
     * @return boolean
     */
    protected function hasMigration($path)
    {
        return is_dir(base_path('plugins/'. $path.'/database/migrations/'));
    }
}
