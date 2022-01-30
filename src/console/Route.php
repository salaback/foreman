<?php

namespace Intellicoreltd\Generators\Console;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Facades\Intellicoreltd\Generators\Generators;
use Intellicoreltd\Generators\Facades\Generate;

class Route extends Command
{
    protected $signature = 'generate:route {model} {--N|namespace} {--M|module}';

    protected $description = 'Create a route';

    public function handle()
    {

        $model = Str::studly(Str::singular($this->argument('model')));
        $module = Str::kebab($this->option('module'));
        $namespace = $this->option('namespace');

        $this->info('Generating ' . $model . ' Route');

        $location = base_path('routes/api.php');

        Generate::route($location, $model, $namespace, $module);

        $this->info('route generated');
    }
}
