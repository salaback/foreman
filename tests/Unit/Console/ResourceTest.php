<?php

namespace Alablaster\Foreman\Tests\Unit\Console;

use Illuminate\Support\Facades\Artisan;
use Alablaster\Foreman\Facades\Foreman;
use Alablaster\Foreman\Tests\TestCase;

class ResourceTest extends TestCase
{
    public function test_normal()
    {
        Foreman::shouldReceive('resource')
            ->with(base_path('src/Http/Resources/Test/Place/TestResource.php'), 'Test', 'Test\Place');

        Foreman::shouldReceive('collection')
            ->with(base_path('src/Http/Resources/Test/Place/TestCollection.php'), 'Test', 'Test\Place');

        Foreman::shouldReceive('resource')
            ->with(base_path('src/Http/Resources/Test/Place/TestCollectionResource.php'), 'Test', 'Test\Place');

        Artisan::call('foreman:resource', [
            'model' => 'Test',
            '-N' => 'Test\Place',
        ]);
    }
}
