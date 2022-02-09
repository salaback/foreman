<?php

namespace Alablaster\Foreman\Locations;


use Illuminate\Support\Str;

class RequestLocation extends Location
{
    protected string $type;

    public function __construct(string $model, string $namespace, string $domain, string $type)
    {
        $this->model = $model;
        $this->namespace = $namespace;
        $this->domain = $domain;
        $this->type = $type;
    }

    protected function fileName(): string
    {
        return Str::studly($this->type) . Str::studly(Str::singular($this->model)) . 'Request.php';
    }

    protected function getPath(): ?string
    {
        return config('foreman.locations.request');
    }
}
