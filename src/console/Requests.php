<?php

namespace Alablaster\Foreman\Console;
use Alablaster\Foreman\Facades\Location;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Alablaster\Foreman\Facades\Foreman;

class Requests extends Command
{
    protected $signature = 'foreman:requests {model} {--N|namespace} {--D|domain}';

    protected $description = 'Create request classes';

    public function handle()
    {
        $model = Str::studly(Str::singular($this->argument('model')));
        $namespace = $this->option('namespace');
        $domain = $this->option('domain');

        $createLocation = Location::request($model, $namespace, 'Create', $domain);
        $updateLocation = Location::request($model, $namespace, 'Update', $domain);

        $this->info('Generating ' . $model . ' request classes');

        Foreman::requests($createLocation, $model, $namespace, 'create');
        Foreman::requests($updateLocation, $model, $namespace, 'update');

        $this->info('Request classes generated');
    }
}
