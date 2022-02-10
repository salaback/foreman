<?php

namespace Alablaster\Foreman\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *  @method static string migration(string $model)
 *  @method static string model(string $model, string $namespace, ?string $domain)
 *  @method static string factory(string $model, string $namespace)
 *  @method static string controller(string $model, ?string $namespace, ?string $module, ?string $domain)
 *  @method static string routes(string $type)
 *  @method static string request(string $model, string $type, ?string $namespace, ?string $domain)
 *  @method static string resource(string $model, string $type, ?string $namespace, ?string $domain)
 *  @method static string collection(string $model, string $namespace, ?$domain)

 */

class Location extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'location';
    }
}
