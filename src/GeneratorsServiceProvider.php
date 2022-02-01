<?php

namespace Intellicoreltd\Generators;

use Illuminate\Support\ServiceProvider;
use Intellicoreltd\Generators\Console\Controller;
use Intellicoreltd\Generators\Console\Factory;
use Intellicoreltd\Generators\Console\Migration;
use Intellicoreltd\Generators\Console\Model;
use Intellicoreltd\Generators\Console\Requests;
use Intellicoreltd\Generators\Console\Resource;
use Intellicoreltd\Generators\Console\Route;
use Intellicoreltd\Generators\Generators\RoutesGenerator;

class GeneratorsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('generate', function($app) {
            return new Generators();
        });

        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'generators');

    }

    public function boot()
    {
        $this->commands([
            Model::class,
            Controller::class,
            Migration::class,
            Factory::class,
            Route::class,
            Requests::class,
            Resource::class
        ]);
    }
}
