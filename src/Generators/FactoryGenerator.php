<?php

namespace Alablaster\Foreman\Generators;

use Alablaster\Foreman\Facades\Location;
use Alablaster\Foreman\Locations\FactoryLocation;
use Alablaster\Foreman\Stubs\StubType;

class FactoryGenerator extends Generator
{
    public function __construct(?string $model = null, ?string $namespace = null)
    {
        parent::__construct(
            model: $model,
            namespace: $namespace,
        );
    }

    protected function getStubType(): StubType
    {
        return StubType::Factory;
    }

    protected function getLocation(): string
    {
        return Location::factory($this->model, $this->namespace);
    }
}
