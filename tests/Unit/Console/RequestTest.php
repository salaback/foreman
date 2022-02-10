<?php

namespace Alablaster\Foreman\Tests\Unit\Console;

use Alablaster\Foreman\Facades\Location;
use Illuminate\Support\Facades\Artisan;
use Alablaster\Foreman\Facades\Foreman;
use Alablaster\Foreman\Tests\TestCase;

class RequestTest extends TestCase
{
    public function test_normal()
    {

        $location = 'location';

        Foreman::shouldReceive('requests')
            ->with($location, 'Test', 'Test\Place', 'create');

        Foreman::shouldReceive('requests')
            ->with($location, 'Test', 'Test\Place', 'update');

        Location::shouldReceive('request')
            ->with('Test', 'Create', 'Test\Place', '')
            ->andReturn($location)
            ->once();

        Location::shouldReceive('request')
            ->with('Test', 'Update', 'Test\Place', '')
            ->andReturn($location)
            ->once();

        Artisan::call('foreman:requests', [
            'model' => 'Test',
            '-N' => 'Test\Place',
        ]);
    }
}
