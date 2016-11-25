<?php

namespace App\Providers;

use Illuminate\Contracts\View\Factory as View;
use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(View $view)
    {
        $theme = 'default';
        $view->addNameSpace('theme', [
            base_path()."/resources/views/themes/$theme",
            base_path().'/resources/views/themes/default',
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        //
    }
}
