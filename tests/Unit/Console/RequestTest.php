<?php

namespace Intellicoreltd\Generators\Tests\Unit\Console;

use Illuminate\Support\Facades\Artisan;
use Intellicoreltd\Generators\Facades\Generate;
use Intellicoreltd\Generators\Tests\TestCase;

class RequestTest extends TestCase
{
    public function test_normal()
    {

        Generate::shouldReceive('requests')
            ->with(base_path('src/Http/Requests/Test/Place/CreateTestRequest.php'), 'Test', 'Test\Place', 'create');

        Generate::shouldReceive('requests')
            ->with(base_path('src/Http/Requests/Test/Place/UpdateTestRequest.php'), 'Test', 'Test\Place', 'update');

        Artisan::call('generate:requests', [
            'model' => 'Test',
            '-N' => 'Test\Place',
        ]);
    }
}
