<?php

namespace Intellicoreltd\Generators\Console;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Facades\Intellicoreltd\Generators\Generators;
use Intellicoreltd\Generators\Facades\Generate;

class Controller extends Command
{
    protected $signature = 'generate:controller {model} {--N|namespace} {--M|module}';

    protected $description = 'Create a resource controller';

    public function handle()
    {

        $model = Str::studly(Str::singular($this->argument('model')));
        $namespace = $this->option('namespace');
        $module = $this->option('module');

        $this->info('Generating ' . $model . ' controller');

        $directory = $namespace ? str_replace("\\", "/", $namespace) . '/' : null;

        $location = base_path('src/Http/Controllers/' . $directory . $model . 'Controller.php');

        Generate::controller($location, $model, $namespace, $module);

        $this->info("${model} controller created.");
    }
}
