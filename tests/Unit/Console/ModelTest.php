<?php

namespace Intellicoreltd\Generators\Tests\Unit\Console;

use Illuminate\Support\Facades\Artisan;
use Intellicoreltd\Generators\Facades\Generate;
use Intellicoreltd\Generators\Tests\TestCase;

class ModelTest extends TestCase
{
    public function test_normal()
    {
        Generate::shouldReceive('model')
            ->with(base_path() . '/src/Models/Test/Place/Test.php', 'Test', 'Test\Place')
            ->once();

        Artisan::call('generate:model', [
            'model' => 'Test',
            '-N' => 'Test\Place'
        ]);
    }
}
