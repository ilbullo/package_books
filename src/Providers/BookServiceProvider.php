<?php

namespace Ilbullo\Books\Providers;

use Ilbullo\Books\Http\Livewire\{Bookshelf, Authors, Book, Categories};
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire;

class BookServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        //merge configuration file of the package with the one of the project
        $this->mergeConfigFrom(__DIR__ .'/../config/book.php','books');

        /**************************************
         * Load all Eloquent Query macros
         * from files into Macro directory
         **************************************/

        Collection::make(glob(__DIR__.'/../Macro/*.php'))
            ->mapWithKeys(function ($path) {
                return [$path => pathinfo($path, PATHINFO_FILENAME)];
            })
            ->each(function ($macro, $path) {
                require_once $path;
            });

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

        //load automatically migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        //load automatically translation
        $this->loadJsonTranslationsFrom(__DIR__ .'/../lang');

        if ($this->app->runningInConsole()) {

            $this->publishes([
              __DIR__.'/../config/book.php' => config_path('books.php'),
            ], 'config');

          }
          //Load livewire components
          Livewire::component('bookshelf', Bookshelf::class);
          Livewire::component('authors', Authors::class);
          Livewire::component('categories', Categories::class);
          Livewire::component('book', Book::class);

          $this->configureComponents();

    }

    /*****************************************************
     * Register all custom blade components
     * @return void
     *****************************************************/

    protected function configureComponents()
    {
		$this->callAfterResolving(BladeCompiler::class, function () {
			$this->registerComponent('delete-confirm');
			// Register other components here
		});
	}

    /*****************************************************
     * Register new blade component
     * @return void
     *****************************************************/

    protected function registerComponent(string $component)
    {
        Blade::component('books::layout.components.'.$component, 'books-'.$component);
    }
}
