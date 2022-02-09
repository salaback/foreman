<?php

namespace Alablaster\Foreman\Locations;


use Illuminate\Support\Str;

class ControllerLocation extends Location
{
    protected string $module;

    public function __construct(string $model, string $namespace, string $domain)
    {
        $this->model = $model;
        $this->namespace = $namespace;
        $this->domain = $domain;
    }

    protected function fileName(): string
    {
        return Str::studly(Str::singular($this->model)) . 'Controller.php';
    }

    protected function getPath(): ?string
    {
        return config('foreman.locations.controller');
    }
}
