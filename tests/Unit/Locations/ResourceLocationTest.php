<?php

namespace Alablaster\Foreman\Tests\Unit\Locations;

use Alablaster\Foreman\Locations\ResourceLocation;
use Alablaster\Foreman\Tests\TestCase;

class ResourceLocationTest extends TestCase
{
    public function test_onlyModelName()
    {
        $location = new ResourceLocation(model: 'Test', type: 'Resource');

        $this->assertSame(base_path('src/Http/Resources/TestResource.php'), $location->run());

    }

    public function test_withModelAndNamespace()
    {
        $location = new ResourceLocation(model: 'Test', type: 'Resource', namespace: 'Test\Namespace');

        $this->assertSame(base_path('src/Http/Resources/Test/Namespace/TestResource.php'), $location->run());

    }

    public function test_withModelAndDomain()
    {
        $location = new ResourceLocation(model: 'Test', type: 'Resource', domain: 'TestDomain');

        $this->assertSame(base_path('src/TestDomain/Http/Resources/TestResource.php'), $location->run());

    }
}
