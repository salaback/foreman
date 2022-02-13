<?php

namespace Alablaster\Foreman\Generators;

use Alablaster\Foreman\Facades\Location;
use Alablaster\Foreman\Stubs\StubType;

class MigrationGenerator extends Generator
{
    public function __construct(?string $model = null)
    {
        parent::__construct(
            model: $model,
        );
    }

    protected function getStubType(): StubType
    {
        return StubType::Migration;
    }

    protected function getLocation(): string
    {
        return Location::migration($this->model);
    }
}
