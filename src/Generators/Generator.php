<?php

namespace Alablaster\Foreman\Generators;

use Alablaster\Foreman\Stubs\Stub;
use Alablaster\Foreman\Stubs\StubType;
use Illuminate\Support\Facades\File;
use Alablaster\Foreman\Traits\ApplyFilterTrait;
use Alablaster\Foreman\Traits\InteractsWithFilesTrait;

abstract class Generator
{

    use ApplyFilterTrait;
    use InteractsWithFilesTrait;

    /**
     * @param array $properties
     */
    public function __construct(
        protected ?string $model = null,
        protected ?string $namespace = null,
        protected ?string $domain = null,
        protected ?string $type = null
    )
    {}

    abstract protected function getStubType(): StubType;

    abstract protected function getLocation(): string;

    protected function getProperties(): array
    {
        return [
            'model' => $this->model,
            'namespace' => $this->namespace,
            'domain' => $this->domain,
            'type' => $this->type
        ];
    }

    public function execute(): void
    {
        $stub = new Stub($this->getStubType(), $this->getProperties());

        $this->saveFile($this->getLocation(), $stub->get());
    }

}
