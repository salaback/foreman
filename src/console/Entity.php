<?php

namespace Alablaster\Foreman\console;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Alablaster\Foreman\Facades\Foreman;

class Entity extends Command
{
    protected $signature = 'foreman:entity {model} {--N|namespace} {--D|domain}';

    protected $description = 'Create an entity';

    public function handle()
    {
        $model = Str::studly(Str::singular($this->argument('model')));
        $namespace = $this->option('namespace');
        $domain = $this->option('domain');


        $this->info('Generating ' . $model . ' entity');

        Artisan::call('foreman:controller', [
            'model' => $model,
            '-N' => $namespace,
            '-D' => $domain
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
            '-N' => $namespace,
            '-D' => $domain
        ]);

        Artisan::call('foreman:requests', [
            'model' => $model,
            '-N' => $namespace,
            '-D' => $domain
        ]);

        Artisan::call('foreman:resource', [
            'model' => $model,
            '-N' => $namespace,
            '-D' => $domain
        ]);

        Artisan::call('foreman:route', [
            'model' => $model,
            '-N' => $namespace,
            '-D' => $domain
        ]);

        $this->info('Entity generated');
    }
}
