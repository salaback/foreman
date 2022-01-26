<?php

namespace Intellicoreltd\Generators\Console;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Facades\Intellicoreltd\Generators\Generators;
use Intellicoreltd\Generators\Facades\Generate;

class Model extends Command
{
    protected $signature = 'generate:model {model} {--N|namespace}';

    protected $description = 'Create a model';

    public function handle()
    {

        $model = Str::studly(Str::singular($this->argument('model')));
        $namespace = $this->option('namespace');

        $this->info('Generating ' . $model . ' Model');

        $directory = str_replace("\\", "/", $namespace);

        $location = base_path('src/Models/' . $directory . '/' . $model . '.php');

        Generate::model($location, $model, $namespace);

        $this->info('Inst');
    }
}
