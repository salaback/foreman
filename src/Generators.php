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
     * @param string $model
     * @param string $namespace
     */
    public function model(string $model, string $namespace): void
    {
        $generator = new ModelGenerator($model, $namespace);
        $generator->execute();
    }

    /**
     * @param string $model
     * @param string $namespace
     * @param string $module
     */
    public function controller(string $model, string $namespace): void
    {
        $generator = new ControllerGenerator($model, $namespace);
        $generator->execute();
    }

    /**
     * @param string $model
     */
    public function migration(string $model): void
    {
        $generator = new MigrationGenerator($model);
        $generator->execute();
    }

    /**
     * @param string $model
     * @param string $namespace
     */
    public function factory(string $model, string $namespace): void
    {
        $generator = new FactoryGenerator($model, $namespace);
        $generator->execute();
    }

    /**
     * @param string $model
     * @param string $namespace
     * @param string $domain
     */
    public function route(string $model, ?string $namespace = null, ?string $domain = null): void
    {
        $generator = new RouteGenerator($model, $namespace, $domain);
        $generator->execute();
    }

    /**
     * @param string $model
     * @param string|null $namespace
     * @param string $type
     * @param string|null $domain
     */
    public function requests(string $model, string $type, ?string $namespace = null, ?string $domain = null): void
    {
        $generator = new RequestsGenerator($model, $type, $namespace, $domain);
        $generator->execute();
    }

    /**
     * @param string $location
     * @param string $model
     * @param string $namespace
     * @param $module
     */
    public function resource(string $model, string $type, ?string $namespace  = null, ?string $domain = null): void
    {
        $generator = new ResourceGenerator($model, $type, $namespace, $domain);
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
