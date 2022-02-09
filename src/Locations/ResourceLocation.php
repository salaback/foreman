<?php

namespace Alablaster\Foreman\Locations;


use Illuminate\Support\Str;

class ResourceLocation extends Location
{
    protected string $type;

    public function __construct(string $model, string $namespace, string $type, string $domain)
    {
        $this->model = $model;
        $this->namespace = $namespace;
        $this->domain = $domain;
        $this->type = $type;
    }

    protected function fileName(): string
    {
        return Str::studly(Str::singular($this->model)) . Str::studly($this->type) . '.php';
    }

    protected function getPath(): ?string
    {
        return config('foreman.locations.resource');
    }
}
