<?php

namespace Alablaster\Foreman\Generators;

use Alablaster\Foreman\Facades\Location;
use Alablaster\Foreman\Stubs\StubType;

class RequestsGenerator extends Generator
{
    public function __construct(
        string $model,
        string $type,
        ?string $namespace = null,
        ?string $domain = null)
    {
        parent::__construct(
            model: $model,
            namespace: $namespace,
            domain: $domain,
            type: $type
        );
    }

    protected function getStubType(): StubType
    {
        return StubType::Request;
    }

    protected function getLocation(): string
    {
        return Location::request($this->model, $this->type, $this->namespace, $this->domain);
    }
}
