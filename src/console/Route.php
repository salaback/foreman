<?php

namespace Alablaster\Foreman\console;
use Alablaster\Foreman\Facades\Location;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Alablaster\Foreman\Facades\Foreman;

class Route extends Command
{
    protected $signature = 'foreman:route {model} {--N|namespace} {--D|domain}';

    protected $description = 'Create a route';

    public function handle()
    {

        $model = Str::studly(Str::singular($this->argument('model')));
        $domain = Str::kebab($this->option('domain'));
        $namespace = $this->option('namespace');

        $this->info('Generating ' . $model . ' Route');

        $location = Location::route('api');

        Foreman::route($location, $model, $namespace, $domain);

        $this->info('route generated');
    }
}
