<?php

namespace Alablaster\Foreman\Locations;


use Illuminate\Support\Str;

class RequestLocation extends Location
{
    public function __construct(
        public string $model,
        public string $type,
        public ?string $namespace = null,
        public  ?string $domain = null,
    )
    {
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
