<?php

namespace Alablaster\Generators\Tests\Unit\Console;

use Illuminate\Support\Facades\Artisan;
use Alablaster\Generators\Facades\Generate;
use Alablaster\Generators\Tests\TestCase;

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
