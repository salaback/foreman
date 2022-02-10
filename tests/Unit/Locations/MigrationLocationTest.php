<?php

namespace Alablaster\Foreman\Tests\Unit\Locations;

use Alablaster\Foreman\Locations\ControllerLocation;
use Alablaster\Foreman\Locations\MigrationLocation;
use Alablaster\Foreman\Tests\TestCase;

class MigrationLocationTest extends TestCase
{
    public function test_onlyModelName()
    {
        $location = new MigrationLocation('Test');

        $this->assertStringContainsString(base_path('database/migrations/'), $location->run());
        $this->assertStringContainsString('_create_tests_table.php', $location->run());
    }
}
