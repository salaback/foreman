<?php

namespace Intellicoreltd\Generators\Generators;

class RouteGenerator extends Generator
{
    public function __construct(string $location, string $model, string $namespace, string $module)
    {
        $stubPath = __DIR__ . '/stubs/routes.stub';
        $properties = [
            'model' => $model,
            'namespace' => $namespace,
            'module'=> $module
        ];

        parent::__construct(
            location: $location,
            stubPath: $stubPath,
            properties: $properties
        );
    }
}
