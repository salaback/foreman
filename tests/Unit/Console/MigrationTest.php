<?php

namespace Alablaster\Generators\Tests\Unit\Console;

use Illuminate\Support\Facades\Artisan;
use Alablaster\Generators\Facades\Generate;
use Alablaster\Generators\Tests\TestCase;

class MigrationTest extends TestCase
{
    public function test_normal()
    {
        Generate::shouldReceive('migration')
            ->once();

        Artisan::call('generate:migration', [
            'model' => 'Test',
        ]);
    }
}
