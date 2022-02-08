<?php

namespace Alablaster\Foreman\Tests\Unit\Console;

use Illuminate\Support\Facades\Artisan;
use Alablaster\Foreman\Facades\Generate;
use Alablaster\Foreman\Tests\TestCase;

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
