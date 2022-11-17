<?php

namespace Ilbullo\Books\Providers;

use Illuminate\Support\ServiceProvider;

class BookServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //load routes of the package
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // load views of the package
        $this->loadViewsFrom(__DIR__.'/../views','books');

        //merge configuration file of the package with the one of the project
        $this->mergeConfigFrom(__DIR__ .'/../config/book.php','books');

        //load automatically migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

    }
}
