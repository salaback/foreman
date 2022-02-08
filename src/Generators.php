<?php

namespace Alablaster\Foreman;

use Alablaster\Foreman\Generators\CollectionGenerator;
use Alablaster\Foreman\Generators\ControllerGenerator;
use Alablaster\Foreman\Generators\FactoryGenerator;
use Alablaster\Foreman\Generators\MigrationGenerator;
use Alablaster\Foreman\Generators\ModelGenerator;
use Alablaster\Foreman\Generators\RequestsGenerator;
use Alablaster\Foreman\Generators\ResourceGenerator;
use Alablaster\Foreman\Generators\RouteGenerator;


class Generators
{
    /**
     * @param string $location
     * @param string $model
     * @param string $namespace
     */
    public function model(string $location, string $model, string $namespace): void
    {
        $generator = new ModelGenerator($location, $model, $namespace);
        $generator->execute();
    }

    /**
     * @param string $location
     * @param string $model
     * @param string $namespace
     * @param string $module
     */
    public function controller(string $location, string $model, string $namespace, string $module): void
    {
        $generator = new ControllerGenerator($location, $model, $namespace, $module);
        $generator->execute();
    }

    /**
     * @param string $location
     * @param string $model
     */
    public function migration(string $location, string $model): void
    {
        $generator = new MigrationGenerator($location, $model);
        $generator->execute();
    }

    /**
     * @param string $location
     * @param string $model
     */
    public function factory(string $location, string $model, string $namespace): void
    {
        $generator = new FactoryGenerator($location, $model, $namespace);
        $generator->execute();
    }

    /**
     * @param string $location
     * @param string $model
     * @param string $namespace
     * @param $module
     */
    public function route(string $location, string $model, string $namespace, string $module): void
    {
        $generator = new RouteGenerator($location, $model, $namespace, $module);
        $generator->execute();
    }

    /**
     * @param string $location
     * @param string $model
     * @param string $namespace
     * @param $module
     */
    public function requests(string $location, string $model, string $namespace, string $type): void
    {
        $generator = new RequestsGenerator($location, $model, $namespace, $type);
        $generator->execute();
    }

    /**
     * @param string $location
     * @param string $model
     * @param string $namespace
     * @param $module
     */
    public function resource(string $location, string $model, string $namespace): void
    {
        $generator = new ResourceGenerator($location, $model, $namespace);
        $generator->execute();
    }

    /**
     * @param string $location
     * @param string $model
     * @param string $namespace
     * @param $module
     */
    public function collection(string $location, string $model, string $namespace): void
    {
        $generator = new CollectionGenerator($location, $model, $namespace);
        $generator->execute();
    }
}
