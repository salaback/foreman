<?php

namespace Alablaster\Foreman\Tests\Unit\Console;

use Illuminate\Support\Facades\Artisan;
use Alablaster\Foreman\Facades\Foreman;
use Alablaster\Foreman\Tests\TestCase;

class EntityTest extends TestCase
{
    public function test_normal()
    {
        Foreman::shouldReceive('collection')
            ->with(base_path('app/Http/Resources/Test/Place/TestCollection.php'), 'Test', 'Test\Place')
            ->once();

        Foreman::shouldReceive('controller')
            ->with(base_path() . '/app/Http/Controllers/Test/Place/TestController.php', 'Test', 'Test\Place', false)
            ->once();

        Foreman::shouldReceive('factory')
            ->with(base_path() . '/database/factories/Test/Place/TestFactory.php', 'Test', 'Test\Place')
            ->once();

        Foreman::shouldReceive('migration')
            ->once();

        Foreman::shouldReceive('model')
            ->with(base_path() . '/app/Models/Test/Place/Test.php', 'Test', 'Test\Place')
            ->once();

        Foreman::shouldReceive('resource')
            ->with(base_path('app/Http/Resources/Test/Place/TestResource.php'), 'Test', 'Test\Place')
            ->once();

        Foreman::shouldReceive('resource')
            ->with(base_path('app/Http/Resources/Test/Place/TestCollectionResource.php'), 'Test', 'Test\Place')
            ->once();

        Foreman::shouldReceive('requests')
            ->with(base_path('app/Http/Requests/Test/Place/CreateTestRequest.php'), 'Test', 'Test\Place', 'create')
            ->once();

        Foreman::shouldReceive('requests')
            ->with(base_path('app/Http/Requests/Test/Place/UpdateTestRequest.php'), 'Test', 'Test\Place', 'update')
            ->once();

        Foreman::shouldReceive('route')
            ->with(base_path() . '/routes/api.php', 'Test', 'Test\Place', '')
            ->once();

        Artisan::call('foreman:entity', [
            'model' => 'Test',
            '-N' => 'Test\Place',
        ]);
    }
}
