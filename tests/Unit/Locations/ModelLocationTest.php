<?php

namespace Alablaster\Foreman\Tests\Unit\Locations;

use Alablaster\Foreman\Locations\ModelLocation;
use Alablaster\Foreman\Tests\TestCase;

class ModelLocationTest extends TestCase
{
    public function test_onlyModelName()
    {
        $location = new ModelLocation('Test');

        $this->assertSame(base_path('app/Models/Test.php'), $location->run());

    }

    public function test_withModelAndNamespace()
    {
        $location = new ModelLocation(model:'Test', namespace: 'Test\Namespace');

        $this->assertSame(base_path('app/Models/Test/Namespace/Test.php'), $location->run());

    }

    public function test_withModelAndDomain()
    {
        $location = new ModelLocation(model:'Test', domain: 'TestDomain');

        $this->assertSame(base_path('app/TestDomain/Models/Test.php'), $location->run());

    }
}
