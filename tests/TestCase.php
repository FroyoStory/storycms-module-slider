<?php

use Orchestra\Testbench\BrowserKit\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected function getEnvironmentSetUp($app)
    {
        putenv('APP_DEBUG=1');

        $app['config']->set('database.default', 'mysql');
        $app['config']->set('database.connections.mysql', [
            'driver' => 'mysql',
            'host' => env('DB_HOST', 'localhost'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
        ]);
        $app['config']->set('app.key', 'SomsRandomStringWith32Characters');
        $app['config']->set('app.cipher', MCRYPT_RIJNDAEL_128);
    }

    protected function getPackageProvider($app)
    {
        return ['Story\Cms\StoryCmsServiceProvider'];
    }
}
