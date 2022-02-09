<?php

namespace Alablaster\Foreman;

use Alablaster\Foreman\Locations\ControllerLocation;
use Alablaster\Foreman\Locations\FactoryLocation;
use Alablaster\Foreman\Locations\MigrationLocation;
use Alablaster\Foreman\Locations\ModelLocation;
use Alablaster\Foreman\Locations\RequestLocation;
use Alablaster\Foreman\Locations\ResourceLocation;
use Alablaster\Foreman\Locations\RouteLocation;


class Locations
{
    /**
     * @param string $model
     * @param string $namespace
     * @param string|null $domain
     * @return string
     */
    public function model(string $model, string $namespace, ?string $domain): string
    {
        $location = new ModelLocation($model, $namespace, $domain);

        return $location->run();
    }

    /**
     * @param string $model
     * @param string $namespace
     * @param string $module
     */
    public function controller(string $model, string $namespace, string $module): void
    {
        $location = new ControllerLocation($model, $namespace, $module);
        $location->run();
    }

    /**
     * @param string $model
     * @return string
     */
    public function migration(string $model): string
    {
        $location = new MigrationLocation($model);
        return $location->run();
    }

    /**
     * @param string $model
     * @param string $namespace
     * @return string
     */
    public function factory(string $model, string $namespace): string
    {
        $location = new FactoryLocation($model, $namespace);
        return $location->run();
    }

    /**
     * @param string $type
     * @return string
     */
    public function route(string $type): string
    {
        $location = new RouteLocation($type);

        return $location->run();
    }

    /**
     * @param string $model
     * @param string $namespace
     * @param string $type
     * @param string|null $domain
     * @return string
     */
    public function request(string $model, string $namespace, string $type, ?string $domain): string
    {
        $location = new RequestLocation($model, $namespace, $domain, $type);
        return $location->run();
    }

    /**
     * @param string $model
     * @param string $namespace
     * @param string $type
     * @param string|null $domain
     * @return string
     */
    public function resource(string $model, string $namespace, string $type, ?string $domain): string
    {
        $location = new ResourceLocation($model, $namespace, $type, $domain);
        return $location->run();
    }
}
