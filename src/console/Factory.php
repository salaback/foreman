<?php

namespace Intellicoreltd\Generators\Console;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Facades\Intellicoreltd\Generators\Generators;
use Intellicoreltd\Generators\Facades\Generate;

class Factory extends Command
{
    protected $signature = 'generate:factory {model} {--N|namespace}';

    protected $description = 'Create a factory';

    public function handle()
    {

        $model = Str::studly(Str::singular($this->argument('model')));
        $namespace = $this->option('namespace');

        $this->info('Generating ' . $model . ' Model');

        $directory = str_replace("\\", "/", $namespace);

        $location = base_path('database/factories/' . $directory . '/' . $model . 'Factory.php');

        Generate::factory($location, $model, $namespace);

        $this->info("Generated $model factory");
    }
}
