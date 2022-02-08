<?php

namespace Alablaster\Foreman\Console;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Facades\Intellicoreltd\Generators\Generators;
use Alablaster\Foreman\Facades\Generate;

class Resource extends Command
{
    protected $signature = 'generate:resource {model} {--N|namespace}';

    protected $description = 'Create resource classes';

    public function handle()
    {
        $model = Str::studly(Str::singular($this->argument('model')));
        $namespace = $this->option('namespace');
        $directory = $namespace ? str_replace("\\", "/", $namespace) . '/' : null;

        $resourceLocation = base_path('src/Http/Resources/' . $directory . $model . 'Resource.php');
        $collectionResourceLocation = base_path('src/Http/Resources/' . $directory . $model . 'CollectionResource.php');
        $collectionLocation = base_path('src/Http/Resources/' . $directory . $model . 'Collection.php');

        $this->info('Generating ' . $model . ' resource classes');

        Generate::resource($resourceLocation, $model, $namespace);
        Generate::resource($collectionResourceLocation, $model, $namespace);
        Generate::collection($collectionLocation, $model, $namespace);

        $this->info('Resource classes generated');
    }
}
