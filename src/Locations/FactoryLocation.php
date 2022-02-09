<?php

namespace Alablaster\Foreman\Locations;


use Illuminate\Support\Str;

class FactoryLocation extends Location
{

    public function __construct(string $model, string $namespace)
    {
        $this->model = $model;
        $this->namespace = $namespace;
        $this->domain = '';

        $this->inSource = false;
    }


    protected function fileName(): string
    {
        return Str::studly(Str::singular($this->model)) . 'Factory.php';
    }

    protected function getPath(): ?string
    {
        return config('foreman.locations.factory');
    }
}
