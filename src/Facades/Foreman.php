<?php

namespace Alablaster\Foreman\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *  @method static void migration(string $model)
 *  @method static void model(string $model, ?string $namespace = null)
 *  @method static void factory(string $model, ?string $namespace = null)
 *  @method static void controller(string $model, ?string $namespace = null)
 *  @method static void route(string $model, ?string $namespace = null, ?string $domain = null)
 *  @method static void requests(string $model, string $type, ?string $namespace = null, ?string $domain = null)
 *  @method static void resource(string $model, string $type, ?string $namespace = null, ?string $domain = null)
 *  @method static void collection(string $model, ?string $namespace = null)

 */

class Foreman extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'foreman';
    }
}
