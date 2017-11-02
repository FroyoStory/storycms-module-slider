<?php

namespace Story\Framework\Backend\Middleware;

use App;
use Closure;
use Jenssegers\Date\Date;

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
            Date::setLocale($locale);
        }

        return $next($request);
    }
}
