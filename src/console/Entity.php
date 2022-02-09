<?php

namespace Alablaster\Foreman\console;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Alablaster\Foreman\Facades\Foreman;

class Entity extends Command
{
    protected $signature = 'foreman:entity {model} {--N|namespace} {--M|module}';

    protected $description = 'Create an entity';

    public function handle()
    {

        $model = Str::studly(Str::singular($this->argument('model')));
        $module = $this->option('module') ? Str::kebab($this->option('module')) : Str::kebab($model);
        $namespace = $this->option('namespace');

        $this->info('Generating ' . $model . ' entity');

        Artisan::call('foreman:controller', [
            'model' => $model,
            '-N' => $namespace,
            '-M' => $module
        ]);

        Artisan::call('foreman:factory', [
            'model' => $model,
            '-N' => $namespace,
        ]);

        Artisan::call('foreman:migration', [
            'model' => $model,
        ]);

        Artisan::call('foreman:model', [
            'model' => $model,
            '-N' => $namespace
        ]);

        Artisan::call('foreman:requests', [
            'model' => $model,
            '-N' => $namespace
        ]);

        Artisan::call('foreman:resource', [
            'model' => $model,
            '-N' => $namespace
        ]);

        Artisan::call('foreman:route', [
            'model' => $model,
            '-N' => $namespace,
            '-M' => $module
        ]);

        $this->info('Entity generated');
    }
}
