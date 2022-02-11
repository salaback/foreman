<?php

namespace Alablaster\Foreman\Generators;

class ControllerGenerator extends Generator
{
    public function __construct(string $location, string $model, string $namespace )
    {
        $stubPath = __DIR__ . '/stubs/resource-controller.stub';
        $properties = [
            'model' => $model,
            'namespace' => $namespace,
        ];

        parent::__construct(
            location: $location,
            stubPath: $stubPath,
            properties: $properties
        );
    }
}
