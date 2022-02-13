<?php

namespace Alablaster\Foreman\Generators;

use Alablaster\Foreman\Exceptions\MissingHydrationProperty;
use Alablaster\Foreman\Exceptions\MissingStubException;
use Alablaster\Foreman\Facades\Location;
use Alablaster\Foreman\Locations\RouteLocation;
use Alablaster\Foreman\Stubs\Stub;
use Alablaster\Foreman\Stubs\StubType;
use Alablaster\Foreman\Traits\InteractsWithFilesTrait;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use function PHPUnit\Framework\stringContains;

class RouteGenerator extends Generator
{

    use InteractsWithFilesTrait;

    public function __construct(
        string $model,
        ?string $namespace = null,
        ?string $domain = null)
    {
        parent::__construct(
            model: $model,
            namespace: $namespace,
            domain: $domain,
        );
    }

    public function execute(): void
    {
        $stub = new Stub($this->getStubType(), $this->getProperties());

        $this->saveFile($this->getLocation(), $stub->get());
    }

    protected function loadStub(): void
    {
        if(!File::exists($this->location)) {
            if($this->stub == null) {
                $this->stub = File::get($this->stubPath);
                return;
            }
            if($this->stubPath == null) {
                throw new MissingStubException();
            }
        } else {

            if(!array_key_exists('domain', $this->properties)) {
                throw new MissingHydrationProperty('domain');
            }

            if(strpos($this->stub, '/* ' . Str::title($this->properties['domain']). ' Resource Controllers */')) {
                $this->addNewRouteToStub();
            } else {
                $this->addNewDomainToStub();
            }
        }

    }

    private function addNewRouteToStub(): void
    {
        $this->stub = File::get($this->location);

        $newRoute = File::get(__DIR__ . '/stubs/new-route.stub');

        $insertPoint = strpos($this->stub, '/* End ' . Str::title($this->properties['module']) . ' Resource Controllers */');

        $this->stub = substr_replace($this->stub, $newRoute, $insertPoint, 0);
    }

    private function addNewDomainToStub(): void
    {
        $this->stub = File::get($this->location);

        $newModule = File::get(__DIR__ . '/stubs/new-route-domain.stub');

        $insertPoint = strpos($this->stub, '/* Domain Routes */') + 21;

        $this->stub = substr_replace($this->stub, $newModule, $insertPoint, 0);
    }

    protected function getStubType(): StubType
    {
        return StubType::Routes;
    }

    protected function getLocation(): string
    {
        return Location::route($this->model, $this->namespace, $this->domain);
    }
}
