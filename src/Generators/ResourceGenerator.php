<?php

namespace Intellicoreltd\Generators\Generators;

class ResourceGenerator extends Generator
{
    public function __construct(string $location, string $model, string $namespace)
    {
        $stubPath = __DIR__ . '/stubs/resource.stub';
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
