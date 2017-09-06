<?php

namespace Story\Cms\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Story\Cms\Config\ConfigManager
 */
class Configuration extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Story\Cms\Config\ConfigManager';
    }
}
