<?php

namespace Alablaster\Foreman\Locations;


use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class MigrationLocation extends Location
{

    public function __construct(string $model)
    {
        $this->model = $model;
        $this->namespace = '';
        $this->domain = '';
        $this->inSource = false;
    }

    protected function fileName(): string
    {
        return Carbon::now()->year . '_' . Carbon::now()->month . '_' . Carbon::now()->day
            . '_' . Carbon::now()->milliseconds . '_create_' . Str::snake(Str::plural($this->model) . '_table.php');

    }

    protected function getPath(): ?string
    {
        return config('foreman.locations.migration');
    }
}
