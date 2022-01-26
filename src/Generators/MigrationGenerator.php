<?php

namespace Intellicoreltd\Generators\Generators;

class MigrationGenerator extends Generator
{
    public function __construct(string $location, string $model)
    {
        $stubPath = __DIR__ . '/stubs/migration.stub';
        $properties = [
            'model' => $model,
        ];

        parent::__construct(
            location: $location,
            stubPath: $stubPath,
            properties: $properties
        );
    }
}
