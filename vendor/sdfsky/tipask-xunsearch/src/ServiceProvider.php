<?php namespace Sdfsky\TipaskXunSearch;

use Sdfsky\TipaskXunSearch\Model\Config as ModelsConfig;
use Config;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/config/xunsearch.php', config_path('xunsearch'));
    }
    public function register()
    {

        $this->publishes([
            __DIR__ . '/config/xunsearch.php' => config_path('xunsearch.php'),
        ]);

        $this->app->singleton('xunsearch.project', function () {
            return Config::get('xunsearch.project');
        });

        $this->app->singleton('xunsearch.models.config', function ($app) {
            return new ModelsConfig(
                Config::get('xunsearch.index.models'),
                $app->make('Sdfsky\TipaskXunSearch\Model\Factory')
            );
        });


        $this->app->singleton('search', function ($app) {
            return new Search(
                $app['xunsearch.project'],
                $app['xunsearch.models.config']
            );
        });


        $this->app->singleton('command.search.rebuild', function () {
            return new Console\RebuildCommand;
        });

        $this->app->singleton('command.search.clear', function () {
            return new Console\ClearCommand;
        });

        $this->commands(array('command.search.rebuild', 'command.search.clear'));
    }
}