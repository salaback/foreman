<?php

namespace Intellicoreltd\Generators\Console;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Facades\Intellicoreltd\Generators\Generators;
use Intellicoreltd\Generators\Facades\Generate;

class Requests extends Command
{
    protected $signature = 'generate:requests {model} {--N|namespace}';

    protected $description = 'Create request classes';

    public function handle()
    {
        $model = Str::studly(Str::singular($this->argument('model')));
        $namespace = $this->option('namespace');
        $directory = $namespace ? str_replace("\\", "/", $namespace) . '/' : null;

        $createLocation = base_path('src/Http/Requests/' . $directory . 'Create' . $model . 'Request.php');
        $updateLocation = base_path('src/Http/Requests/' . $directory . 'Update' . $model . 'Request.php');

        $this->info('Generating ' . $model . ' request classes');

        Generate::requests($createLocation, $model, $namespace, 'create');
        Generate::requests($updateLocation, $model, $namespace, 'update');

        $this->info('Request classes generated');
    }
}
