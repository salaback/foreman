<?php

namespace Intellicoreltd\Generators;

use Intellicoreltd\Generators\Contracts\GeneratorsContract;
use Intellicoreltd\Generators\Generators\ControllerGenerator;
use Intellicoreltd\Generators\Generators\MigrationGenerator;
use Intellicoreltd\Generators\Generators\ModelGenerator;



class Generators implements GeneratorsContract
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
}
