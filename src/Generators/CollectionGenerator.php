<?php

namespace Alablaster\Foreman\Generators;

use Alablaster\Foreman\Facades\Location;
use Alablaster\Foreman\Stubs\StubType;

class CollectionGenerator extends Generator
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
        return StubType::Collection;
    }

    protected function getLocation(): string
    {
        return Location::collection($this->model, $this->namespace, $this->domain);
    }
}
