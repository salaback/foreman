<?php

namespace Alablaster\Foreman\Locations;


use Illuminate\Support\Str;

class ModelLocation extends Location
{
    protected function fileName(): string
    {
        return Str::studly(Str::singular($this->model)) . '.php';
    }

    protected function getPath(): ?string
    {
        return config('foreman.locations.model');
    }
}
