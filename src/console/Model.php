<?php

namespace Alablaster\Foreman\Console;
use Alablaster\Foreman\Facades\Location;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Alablaster\Foreman\Facades\Foreman;

class Model extends Command
{
    protected $signature = 'foreman:model {model} {--N|namespace} {--D|domain}';

    protected $description = 'Create a model';

    public function handle()
    {

        $model = Str::studly(Str::singular($this->argument('model')));
        $namespace = $this->option('namespace');
        $domain = $this->option('domain');

        $this->info('Generating ' . $model . ' Model');

        $location = Location::model($model, $namespace, $domain);

        Foreman::model($location, $model, $namespace);

        $this->info('Inst');
    }
}
