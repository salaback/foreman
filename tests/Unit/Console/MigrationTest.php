<?php

namespace Intellicoreltd\Generators\Tests\Unit\Console;

use Illuminate\Support\Facades\Artisan;
use Intellicoreltd\Generators\Facades\Generate;
use Intellicoreltd\Generators\Tests\TestCase;

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
