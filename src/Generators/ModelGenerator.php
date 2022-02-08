<?php

namespace Alablaster\Foreman\Generators;

class ModelGenerator extends Generator
{
    public function __construct(string $location, string $model, string $namespace )
    {
        $stubPath = __DIR__ . '/stubs/model.stub';
        $properties = [
            'model' => $model,
            'namespace' => $namespace
        ];

        parent::__construct(
            location: $location,
            stubPath: $stubPath,
            properties: $properties
        );
    }
}
