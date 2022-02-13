<?php

namespace Alablaster\Foreman\Generators;

use Alablaster\Foreman\Facades\Location;
use Alablaster\Foreman\Locations\ControllerLocation;
use Alablaster\Foreman\Stubs\StubType;

class ControllerGenerator extends Generator
{
    public function __construct(?string $model = null, ?string $namespace = null, ?string $domain = null)
    {
        parent::__construct(
            model: $model,
            namespace: $namespace,
            domain: $domain
        );
    }

    protected function getStubType(): StubType
    {
        return StubType::Controller;
    }

    protected function getLocation(): string
    {
        return Location::controller($this->model, $this->namespace, null);
    }
}
