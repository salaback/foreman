<?php

namespace Alablaster\Foreman\Tests\Unit\Locations;

use Alablaster\Foreman\Locations\ControllerLocation;
use Alablaster\Foreman\Locations\FactoryLocation;
use Alablaster\Foreman\Tests\TestCase;

class FactoryLocationTest extends TestCase
{
    public function test_onlyModelName()
    {
        $location = new FactoryLocation('Test');

        $this->assertSame(base_path('database/factories/TestFactory.php'), $location->run());

    }

    public function test_withModelAndNamespace()
    {
        $location = new FactoryLocation(model:'Test', namespace: 'Test\Namespace');

        $this->assertSame(base_path('database/factories/Test/Namespace/TestFactory.php'), $location->run());

    }
}
