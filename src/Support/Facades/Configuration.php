<?php

namespace Story\Framework\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Story\Framework\Config\ConfigManager
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
        return 'configuration';
    }
}
