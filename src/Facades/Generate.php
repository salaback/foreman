<?php

namespace Intellicoreltd\Generators\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *  @method static void model(string $location, string $model, string $namespace)
 */

class Generate extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'generate';
    }
}
