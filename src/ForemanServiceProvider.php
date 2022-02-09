<?php

namespace Alablaster\Foreman;

use Illuminate\Support\ServiceProvider;
use Alablaster\Foreman\Console\Controller;
use Alablaster\Foreman\Console\Entity;
use Alablaster\Foreman\Console\Factory;
use Alablaster\Foreman\Console\Migration;
use Alablaster\Foreman\Console\Model;
use Alablaster\Foreman\Console\Requests;
use Alablaster\Foreman\Console\Resource;
use Alablaster\Foreman\Console\Route;

class ForemanServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('foreman', function($app) {
            return new Generators();
        });

        $this->app->bind('location', function($app) {
            return new Locations();
        });

        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'foreman');

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
            Resource::class,
            Entity::class
        ]);
    }
}