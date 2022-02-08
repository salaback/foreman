<?php

namespace Alablaster\Foreman\Console;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Alablaster\Foreman\Facades\Generate;

class Entity extends Command
{
    protected $signature = 'generate:entity {model} {--N|namespace} {--M|module}';

    protected $description = 'Create an entity';

    public function handle()
    {

        $model = Str::studly(Str::singular($this->argument('model')));
        $module = $this->option('module') ? Str::kebab($this->option('module')) : Str::kebab($model);
        $namespace = $this->option('namespace');

        $this->info('Generating ' . $model . ' entity');

        Artisan::call('generate:controller', [
            'model' => $model,
            '-N' => $namespace,
            '-M' => $module
        ]);

        Artisan::call('generate:factory', [
            'model' => $model,
            '-N' => $namespace,
        ]);

        Artisan::call('generate:migration', [
            'model' => $model,
        ]);

        Artisan::call('generate:model', [
            'model' => $model,
            '-N' => $namespace
        ]);

        Artisan::call('generate:requests', [
            'model' => $model,
            '-N' => $namespace
        ]);

        Artisan::call('generate:resource', [
            'model' => $model,
            '-N' => $namespace
        ]);

        Artisan::call('generate:route', [
            'model' => $model,
            '-N' => $namespace,
            '-M' => $module
        ]);

        $this->info('Entity generated');
    }
}
