<?php

namespace Alablaster\Foreman\Tests\Unit\Console;

use Illuminate\Support\Facades\Artisan;
use Alablaster\Foreman\Facades\Foreman;
use Alablaster\Foreman\Tests\TestCase;

class MigrationTest extends TestCase
{
    public function test_normal()
    {
        Foreman::shouldReceive('migration')
            ->once();

        Artisan::call('foreman:migration', [
            'model' => 'Test',
        ]);
    }
}
