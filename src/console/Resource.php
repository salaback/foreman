<?php

namespace Alablaster\Foreman\console;
use Alablaster\Foreman\Facades\Location;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Alablaster\Foreman\Facades\Foreman;

class Resource extends Command
{
    protected $signature = 'foreman:resource {model} {--N|namespace} {--D|domain}';

    protected $description = 'Create resource classes';

    public function handle()
    {
        $model = Str::studly(Str::singular($this->argument('model')));
        $namespace = $this->option('namespace');
        $domain = $this->option('domain');

        $resourceLocation = Location::resource($model, $namespace, 'Resource', $domain);
        $collectionResourceLocation = Location::resource($model, $namespace, 'CollectionResource', $domain);
        $collectionLocation = Location::resource($model, $namespace, 'Collection', $domain);

        $this->info('Generating ' . $model . ' resource classes');

        Foreman::resource($resourceLocation, $model, $namespace);
        Foreman::resource($collectionResourceLocation, $model, $namespace);
        Foreman::collection($collectionLocation, $model, $namespace);

        $this->info('Resource classes generated');
    }
}
