<?php

namespace Story\Cms;

use App;
use Closure;
use Date;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request [description]
     * @param  \Closure $next    [description]
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = $request->segment(1);
        $locales = config()->get('translatable.locales');

        if ($locale && in_array($locale, $locales)) {
            App::setLocale($locale);
            Date::setLocale($locale);
        }

        return $next($request);
    }
}
