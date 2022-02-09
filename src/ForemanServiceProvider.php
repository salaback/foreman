<?php

namespace Alablaster\Foreman;

use Illuminate\Support\ServiceProvider;
use Alablaster\Foreman\console\Controller;
use Alablaster\Foreman\console\Entity;
use Alablaster\Foreman\console\Factory;
use Alablaster\Foreman\console\Migration;
use Alablaster\Foreman\console\Model;
use Alablaster\Foreman\console\Requests;
use Alablaster\Foreman\console\Resource;
use Alablaster\Foreman\console\Route;

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
