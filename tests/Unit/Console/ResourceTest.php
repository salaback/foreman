<?php

namespace Alablaster\Foreman\Tests\Unit\Console;

use Alablaster\Foreman\Facades\Location;
use Illuminate\Support\Facades\Artisan;
use Alablaster\Foreman\Facades\Foreman;
use Alablaster\Foreman\Tests\TestCase;

class ResourceTest extends TestCase
{
    public function test_normal()
    {
        $location = 'location';

        Foreman::shouldReceive('resource')
            ->with($location, 'Test', 'Test\Place');

        Foreman::shouldReceive('collection')
            ->with($location, 'Test', 'Test\Place');

        Foreman::shouldReceive('resource')
            ->with($location, 'Test', 'Test\Place');

        Location::shouldReceive('resource')
            ->with('Test', 'Resource', 'Test\Place', '')
            ->andReturn($location)
            ->once();

        Location::shouldReceive('resource')
            ->with('Test', 'CollectionResource', 'Test\Place', '')
            ->andReturn($location)
            ->once();

        Location::shouldReceive('resource')
            ->with('Test', 'Collection', 'Test\Place', '')
            ->andReturn($location)
            ->once();

        Artisan::call('foreman:resource', [
            'model' => 'Test',
            '-N' => 'Test\Place',
        ]);
    }
}
