<?php

namespace Intellicoreltd\Generators\Console;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Facades\Intellicoreltd\Generators\Generators;
use Intellicoreltd\Generators\Facades\Generate;

class Migration extends Command
{
    protected $signature = 'generate:migration {model}';

    protected $description = 'Create a model';

    public function handle()
    {

        $model = Str::studly(Str::singular($this->argument('model')));

        $this->info('Generating ' . $model . ' Migration');

        $location = base_path(
            "database/migrations/" . Carbon::now()->year . '_' . Carbon::now()->month . '_' . Carbon::now()->day
            . '_' . Carbon::now()->milliseconds . '_create_' . Str::snake($model) . '_table.php');

        Generate::migration($location, $model);

        $this->info('Migration created.');
    }
}
