<?php

namespace Story\Cms\Backend\Middleware;

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
        $locale = $request->input('locale');
        $locales = config()->get('translatable.locales');

        if ($locale && in_array($locale, $locales)) {
            App::setLocale($locale);
            Jenssegers\Date\Date::setLocale($locale);
        }

        return $next($request);
    }
}
