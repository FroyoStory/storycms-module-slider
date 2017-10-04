<?php

namespace Story\Cms\Providers;

use Theme;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Blade::directive('render', function($expression) {
            return "<?php echo \$__env->make('theme::".Theme::current().".layouts.".($expression ? : 'app')."', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>";
        });
    }

    public function register()
    {

    }
}
