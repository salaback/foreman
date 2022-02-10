<?php

namespace Alablaster\Foreman\Locations;


use Illuminate\Support\Str;

class ControllerLocation extends Location
{
    public function __construct(
        public string $model,
        public ?string $namespace = null,
        public ?string $domain = null,
        public ?string $module = null
    )
    {

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
