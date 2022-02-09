<?php

namespace Alablaster\Foreman\console;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Alablaster\Foreman\Facades\Foreman;
use Alablaster\Foreman\Facades\Location;

class Migration extends Command
{
    protected $signature = 'foreman:migration {model}';

    protected $description = 'Create a model';

    public function handle()
    {

        $model = Str::studly(Str::singular($this->argument('model')));

        $this->info('Generating ' . $model . ' Migration');

        $location = Location::migration($model);

        Foreman::migration($location, $model);

        $this->info('Migration created.');
    }
}
