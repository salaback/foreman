<?php

namespace Intellicoreltd\Generators\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *  @method static void migration(string $location, string $model)
 *  @method static void model(string $location, string $model, string $namespace)
 *  @method static void controller(string $location, string $model, string $namespace, string $module)
 */

class Generate extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'generate';
    }
}
