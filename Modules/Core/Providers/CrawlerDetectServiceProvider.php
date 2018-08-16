<?php
/**
 * Created by IntelliJ IDEA.
 * User: spbaniya
 * Date: 8/16/18
 * Time: 5:46 PM
 */

namespace Modules\Core\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Core\Services\CrawlerDetect\CrawlerDetect;

class CrawlerDetectServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        //$this->package('Jaybizzle/LaravelCrawlerDetect');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('CrawlerDetect', function ($app) {
            return new CrawlerDetect();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

}
