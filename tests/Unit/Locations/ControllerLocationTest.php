<?php

namespace Alablaster\Foreman\Tests\Unit\Locations;

use Alablaster\Foreman\Locations\ControllerLocation;
use Alablaster\Foreman\Tests\TestCase;

class ControllerLocationTest extends TestCase
{
    public function test_onlyModelName()
    {
        $location = new ControllerLocation('Test');

        $this->assertSame(base_path('app/Http/Controllers/TestController.php'), $location->run());

    }

    public function test_withModelAndNamespace()
    {
        $location = new ControllerLocation(model:'Test', namespace: 'Test\Namespace');

        $this->assertSame(base_path('app/Http/Controllers/Test/Namespace/TestController.php'), $location->run());

    }

    public function test_withModelAndDomain()
    {
        $location = new ControllerLocation(model:'Test', domain: 'TestDomain');

        $this->assertSame(base_path('app/TestDomain/Http/Controllers/TestController.php'), $location->run());

    }
}
