<?php

namespace Alablaster\Generators\Tests\Unit\Console;

use Illuminate\Support\Facades\Artisan;
use Alablaster\Generators\Facades\Generate;
use Alablaster\Generators\Tests\TestCase;

class EntityTest extends TestCase
{
    public function test_normal()
    {
        Generate::shouldReceive('controller')
            ->with(base_path() . '/src/Http/Controllers/Test/Place/TestController.php', 'Test', 'Test\Place', 'test')
            ->once();

        Generate::shouldReceive('factory')
            ->with(base_path() . '/database/factories/Test/Place/TestFactory.php', 'Test', 'Test\Place')
            ->once();

        Generate::shouldReceive('migration')
            ->once();

        Generate::shouldReceive('model')
            ->with(base_path() . '/src/Models/Test/Place/Test.php', 'Test', 'Test\Place')
            ->once();

        Generate::shouldReceive('requests')
            ->with(base_path('src/Http/Requests/Test/Place/CreateTestRequest.php'), 'Test', 'Test\Place', 'create')
            ->once();

        Generate::shouldReceive('requests')
            ->with(base_path('src/Http/Requests/Test/Place/UpdateTestRequest.php'), 'Test', 'Test\Place', 'update')
            ->once();

        Generate::shouldReceive('resource')
            ->with(base_path('src/Http/Resources/Test/Place/TestResource.php'), 'Test', 'Test\Place')
            ->once();

        Generate::shouldReceive('collection')
            ->with(base_path('src/Http/Resources/Test/Place/TestCollection.php'), 'Test', 'Test\Place')
            ->once();

        Generate::shouldReceive('resource')
            ->with(base_path('src/Http/Resources/Test/Place/TestCollectionResource.php'), 'Test', 'Test\Place')
            ->once();

        Generate::shouldReceive('route')
            ->with(base_path() . '/routes/api.php', 'Test', 'Test\Place', 'test')
            ->once();

        Artisan::call('generate:entity', [
            'model' => 'Test',
            '-N' => 'Test\Place',
            '-M' => 'test'
        ]);
    }
}
