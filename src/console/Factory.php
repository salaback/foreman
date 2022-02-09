<?php

namespace Alablaster\Foreman\Console;
use Alablaster\Foreman\Facades\Location;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Alablaster\Foreman\Facades\Foreman;

class Factory extends Command
{
    protected $signature = 'foreman:factory {model} {--N|namespace}';

    protected $description = 'Create a factory';

    public function handle()
    {

        $model = Str::studly(Str::singular($this->argument('model')));
        $namespace = $this->option('namespace');

        $this->info('Generating ' . $model . ' Model');

        $location = Location::factory($model, $namespace);

        Foreman::factory($location, $model, $namespace);

        $this->info("Generated $model factory");
    }
}
