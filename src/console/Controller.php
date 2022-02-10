<?php

namespace Alablaster\Foreman\console;
use Alablaster\Foreman\Facades\Location;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Alablaster\Foreman\Facades\Foreman;

class Controller extends Command
{
    protected $signature = 'foreman:controller {model} {--N|namespace} {--M|module} {--D|domain}';

    protected $description = 'Create a resource controller';

    public function handle()
    {

        $model = Str::studly(Str::singular($this->argument('model')));
        $namespace = $this->option('namespace');
        $module = $this->option('module');
        $domain = $this->option('domain');

        $this->info('Generating ' . $model . ' controller');

        $location = Location::controller($model, $namespace, $domain, $module);

        Foreman::controller($location, $model, $namespace, $module);

        $this->info("${model} controller created.");
    }
}
