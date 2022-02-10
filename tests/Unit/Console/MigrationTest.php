<?php

namespace Alablaster\Foreman\Tests\Unit\Console;

use Alablaster\Foreman\Facades\Location;
use Illuminate\Support\Facades\Artisan;
use Alablaster\Foreman\Facades\Foreman;
use Alablaster\Foreman\Tests\TestCase;

class MigrationTest extends TestCase
{
    public function test_normal()
    {
        $location = 'database/migrations/000000_create_tests_migration.php';

        Foreman::shouldReceive('migration')
            ->with($location, 'Test')
            ->once();

        Location::shouldReceive('migration')
            ->with('Test')
            ->andReturn($location);

        Artisan::call('foreman:migration', [
            'model' => 'Test',
        ]);
    }
}
