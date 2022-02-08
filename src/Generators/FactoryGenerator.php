<?php

namespace Alablaster\Foreman\Generators;

class FactoryGenerator extends Generator
{
    public function __construct(string $location, string $model, string $namespace)
    {
        $stubPath = __DIR__ . '/stubs/factory.stub';
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
