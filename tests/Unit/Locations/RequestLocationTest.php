<?php

namespace Alablaster\Foreman\Tests\Unit\Locations;

use Alablaster\Foreman\Locations\RequestLocation;
use Alablaster\Foreman\Tests\TestCase;

class RequestLocationTest extends TestCase
{
    public function test_onlyModelName()
    {
        $location = new RequestLocation(model: 'Test', type: 'Create');

        $this->assertSame(base_path('app/Http/Requests/CreateTestRequest.php'), $location->run());

    }

    public function test_withModelAndNamespace()
    {
        $location = new RequestLocation(model: 'Test', type: 'Create', namespace: 'Test\Namespace');

        $this->assertSame(base_path('app/Http/Requests/Test/Namespace/CreateTestRequest.php'), $location->run());

    }

    public function test_withModelAndDomain()
    {
        $location = new RequestLocation(model: 'Test', type: 'Create', domain: 'TestDomain');

        $this->assertSame(base_path('app/TestDomain/Http/Requests/CreateTestRequest.php'), $location->run());

    }
}
