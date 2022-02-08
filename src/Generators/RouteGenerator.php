<?php

namespace Alablaster\Foreman\Generators;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Alablaster\Generators\Exceptions\MissingHydrationProperty;
use Alablaster\Generators\Exceptions\MissingStubException;
use function PHPUnit\Framework\stringContains;

class RouteGenerator extends Generator
{
    public function __construct(string $location, string $model, string $namespace, string $module)
    {
        $stubPath = __DIR__ . '/stubs/routes.stub';
        $properties = [
            'model' => $model,
            'namespace' => $namespace,
            'module'=> $module
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

            if(!array_key_exists('module', $this->properties)) {
                throw new MissingHydrationProperty('module');
            }

            if(strpos($this->stub, '/* ' . Str::title($this->properties['module']). ' Resource Controllers */')) {
                $this->addNewRouteToStub();
            } else {
                $this->addNewModuleToStub();
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

    private function addNewModuleToStub(): void
    {
        $this->stub = File::get($this->location);

        $newModule = File::get(__DIR__ . '/stubs/new-route-module.stub');

        $insertPoint = strpos($this->stub, '/* Module Routes */') + 21;

        $this->stub = substr_replace($this->stub, $newModule, $insertPoint, 0);
    }
}
