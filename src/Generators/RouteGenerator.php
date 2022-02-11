<?php

namespace Alablaster\Foreman\Generators;

use Alablaster\Foreman\Exceptions\MissingHydrationProperty;
use Alablaster\Foreman\Exceptions\MissingStubException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use function PHPUnit\Framework\stringContains;

class RouteGenerator extends Generator
{
    public function __construct(string $location, string $model, string $namespace, string $domain)
    {
        $stubPath = __DIR__ . '/stubs/routes.stub';
        $properties = [
            'model' => $model,
            'namespace' => $namespace,
            'domain'=> $domain
        ];

        parent::__construct(
            location: $location,
            stubPath: $stubPath,
            properties: $properties
        );
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
}
