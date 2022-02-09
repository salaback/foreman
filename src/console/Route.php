<?php

namespace Alablaster\Foreman\Console;
use Alablaster\Foreman\Facades\Location;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Alablaster\Foreman\Facades\Foreman;

class Route extends Command
{
    protected $signature = 'foreman:route {model} {--N|namespace} {--M|module}';

    protected $description = 'Create a route';

    public function handle()
    {

        $model = Str::studly(Str::singular($this->argument('model')));
        $module = Str::kebab($this->option('module'));
        $namespace = $this->option('namespace');

        $this->info('Generating ' . $model . ' Route');

        $location = Location::route('api');

        Foreman::route($location, $model, $namespace, $module);

        $this->info('route generated');
    }
}
