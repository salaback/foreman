<?php

namespace Intellicoreltd\Generators\Tests\Unit\Console;

use Illuminate\Support\Facades\Artisan;
use Intellicoreltd\Generators\Facades\Generate;
use Intellicoreltd\Generators\Tests\TestCase;

class ControllerTest extends TestCase
{
    public function test_normal()
    {
        Generate::shouldReceive('controller')
            ->with(base_path() . '/src/Http/Controllers/Test/Place/TestController.php', 'Test', 'Test\Place')
            ->once();

        Artisan::call('generate:controller', [
            'model' => 'Test',
            '-N' => 'Test\Place'
        ]);
    }
}
