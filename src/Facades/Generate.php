<?php

namespace Intellicoreltd\Generators\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *  @method static void migration(string $location, string $model)
 *  @method static void model(string $location, string $model, string $namespace)
 *  @method static void factory(string $location, string $model, string $namespace)
 *  @method static void controller(string $location, string $model, string $namespace, string $module)
 *  @method static void routes(string $location, string $model, string $namespace, string $module)
 *  @method static void requests(string $location, string $model, string $namespace, string $type)
 *  @method static void resource(string $location, string $model, string $namespace)
 *  @method static void collection(string $location, string $model, string $namespace)

 */

class Generate extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'generate';
    }
}
