<?php

namespace Alablaster\Generators\Tests\Unit\Console;

use Illuminate\Support\Facades\Artisan;
use Alablaster\Generators\Facades\Generate;
use Alablaster\Generators\Tests\TestCase;

class ControllerTest extends TestCase
{
    public function test_normal()
    {
        Generate::shouldReceive('controller')
            ->with(base_path() . '/src/Http/Controllers/Test/Place/TestController.php', 'Test', 'Test\Place', 'test')
            ->once();

        Artisan::call('generate:controller', [
            'model' => 'Test',
            '-N' => 'Test\Place',
            '-M' => 'test'
        ]);
    }
}
