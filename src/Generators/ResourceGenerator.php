<?php

namespace Alablaster\Foreman\Generators;

use Alablaster\Foreman\Facades\Location;
use Alablaster\Foreman\Locations\RequestLocation;
use Alablaster\Foreman\Locations\ResourceLocation;
use Alablaster\Foreman\Stubs\StubType;

class ResourceGenerator extends Generator
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
        return match ($this->type) {
            "Collection" => StubType::Collection,
            default => StubType::Resource,
        };
    }

    protected function getLocation(): string
    {
        return Location::resource(
            model: $this->model,
            type: $this->type,
            namespace: $this->namespace,
            domain: $this->domain
        );
    }
}
