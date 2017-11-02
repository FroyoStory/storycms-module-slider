<?php

namespace Story\Framework\Backend\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Story\Framework\Contracts\StoryUser;

class InstallerController extends Controller
{
    protected $env;
    protected $key;
    protected $users;

    /**
     * Create installer storyframework
     *
     * @param StoryUser $users
     */
    public function __construct(StoryUser $users)
    {
        $this->env = file_get_contents(base_path('.env.example'));
        $this->users = $users;
    }

    /**
     * Display installer form
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->checkEnableInstall()) {
            return view('cms::installer.index');
        }
    }

    /**
     * Install the apps
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->checkEnableInstall()) {

            $this->writeNewEnvironmentFileWith('APP_KEY', $this->generateRandomKey());
            $this->writeNewEnvironmentFileWith('DB_HOST', $request->input('database.host'));
            $this->writeNewEnvironmentFileWith('DB_PORT', $request->input('database.port'));
            $this->writeNewEnvironmentFileWith('DB_DATABASE', $request->input('database.name'));
            $this->writeNewEnvironmentFileWith('DB_USERNAME', $request->input('database.username'));
            $this->writeNewEnvironmentFileWith('DB_PASSWORD', $request->input('database.password'));
            $this->writeNewEnvironmentFileWith('DB_CHARSET', $request->input('database.charset'));
            $this->writeNewEnvironmentFileWith('DB_COLLATION', $request->input('database.collation'));

            $this->saveEnvirontmentFilePath();
            $this->runMigrations($request);
            $this->runInsertAdministrator($request);

            return response()->json();
        }
    }

    /**
     * Run database migrations
     *
     * @param  Request $request
     * @return mixed
     */
    protected function runMigrations(Request $request)
    {
        // Temporary set database connection
        config([
            'app.key' => $this->key,
            'database.connections.mysql.database' => $request->input('database.name'),
            'database.connections.mysql.host' => $request->input('database.host'),
            'database.connections.mysql.port' => $request->input('database.port'),
            'database.connections.mysql.username' => $request->input('database.username'),
            'database.connections.mysql.password' => $request->input('database.password'),
            'database.connections.mysql.charset' => $request->input('database.charset'),
            'database.connections.mysql.collation' => $request->input('database.collation'),
        ]);

        Artisan::call('migrate', ['--force' => true ]);
    }

    /**
     * Run insert administrator user
     *
     * @param  Request $request
     * @return mixed
     */
    protected function runInsertAdministrator(Request $request)
    {
        $this->users->create([
            'name' => $request->input('site.name'),
            'email' => $request->input('site.email'),
            'password' => \Hash::make($request->input('site.password')),
            'role_id' => 1
        ]);
    }

    /**
     * Check the apps enable run installer
     *
     * @return boolean
     */
    protected function checkEnableInstall()
    {
        return !file_exists($this->environmentFilePath());
    }

    /**
     * Get environment file path
     *
     * @return string
     */
    protected function environmentFilePath()
    {
        return base_path('.env');
    }

    /**
     * Save environment file
     *
     * @return bool
     */
    protected function saveEnvirontmentFilePath()
    {
        return file_put_contents($this->environmentFilePath(), $this->env);
    }

    /**
     * Write a new environment file with the given key.
     *
     * @param  string  $key
     * @return void
     */
    protected function writeNewEnvironmentFileWith($key, $value)
    {
        $this->env = preg_replace(
            $this->keyReplacementPattern($key),
            $key.'='.$value,
            $this->env
        );
    }

    /**
     * Get a regex pattern that will match env APP_KEY with any random key.
     *
     * @return string
     */
    protected function keyReplacementPattern($key)
    {
        return "/^{$key}=.*/m";
    }

     /**
     * Generate a random key for the application.
     *
     * @return string
     */
    protected function generateRandomKey()
    {
        $this->key = 'base64:'.base64_encode(random_bytes(
            config()->get('app.chipper') == 'AES-128-CBC' ? 16 : 32
        ));

        return $this->key;
    }
}
