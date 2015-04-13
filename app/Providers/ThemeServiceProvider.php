<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\View\Factory as View;
use Illuminate\Contracts\Config\Repository as Config;
class ThemeServiceProvider extends ServiceProvider {
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(View $view, Config $config)
    {
        // Or get the active theme from database
        $theme = $config->get('theme.theme');
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