<?php

namespace Alablaster\Foreman\Locations;


use Illuminate\Support\Str;

class RouteLocation extends Location
{
    public string $type;
    public function __construct(string $type = 'api')
    {
        $this->model = '';
        $this->namespace = '';
        $this->domain = '';
        $this->inSource = false;
        $this->type = $type;
    }

    protected function fileName(): string
    {
        return $this->type . '.php';
    }

    protected function getPath(): ?string
    {
        return config('foreman.locations.routes');
    }
}
