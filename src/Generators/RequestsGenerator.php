<?php

namespace Intellicoreltd\Generators\Generators;

class RequestsGenerator extends Generator
{
    public function __construct(string $location, string $model, string $namespace, string $type )
    {
        $stubPath = __DIR__ . '/stubs/request.stub';
        $properties = [
            'model' => $model,
            'namespace' => $namespace,
            'type' => $type
        ];

        parent::__construct(
            location: $location,
            stubPath: $stubPath,
            properties: $properties
        );
    }
}
