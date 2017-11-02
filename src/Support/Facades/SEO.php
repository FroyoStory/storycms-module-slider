<?php

namespace Story\Framework\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Story\Framework\Support\SEO
 */
class SEO extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'seo';
    }
}
