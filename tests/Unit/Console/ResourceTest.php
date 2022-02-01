<?php

namespace Intellicoreltd\Generators\Tests\Unit\Console;

use Illuminate\Support\Facades\Artisan;
use Intellicoreltd\Generators\Facades\Generate;
use Intellicoreltd\Generators\Tests\TestCase;

class ResourceTest extends TestCase
{
    public function test_normal()
    {
        Generate::shouldReceive('resource')
            ->with(base_path('src/Http/Resources/Test/Place/TestResource.php'), 'Test', 'Test\Place');

        Generate::shouldReceive('collection')
            ->with(base_path('src/Http/Resources/Test/Place/TestCollection.php'), 'Test', 'Test\Place');

        Generate::shouldReceive('resource')
            ->with(base_path('src/Http/Resources/Test/Place/TestCollectionResource.php'), 'Test', 'Test\Place');

        Artisan::call('generate:resource', [
            'model' => 'Test',
            '-N' => 'Test\Place',
        ]);
    }
}
