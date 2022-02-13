<?php

namespace Alablaster\Foreman\Generators;

use Alablaster\Foreman\Facades\Location;
use Alablaster\Foreman\Locations\ModelLocation;
use Alablaster\Foreman\Stubs\StubType;
use JetBrains\PhpStorm\Pure;

class ModelGenerator extends Generator
{
    public function __construct(
        string $model,
        ?string $namespace = null,
        ?string $domain = null
    )
    {
        parent::__construct(
            model: $model,
            namespace: $namespace,
            domain: $domain
        );
    }

    protected function getStubType(): StubType
    {
        return StubType::Model;
    }

    protected function getLocation(): string
    {
        return Location::model($this->model, $this->namespace, $this->domain);
    }
}
