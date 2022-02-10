<?php

namespace Alablaster\Foreman\Tests\Unit\Console;

use Alablaster\Foreman\Facades\Location;
use Illuminate\Support\Facades\Artisan;
use Alablaster\Foreman\Facades\Foreman;
use Alablaster\Foreman\Tests\TestCase;

class FactoryTest extends TestCase
{
    public function test_normal()
    {
        $location = 'database/factories/Test/Place/TestFactory.php';

        Foreman::shouldReceive('factory')
            ->with($location, 'Test', 'Test\Place')
            ->once();

        Location::shouldReceive('factory')
            ->with('Test', 'Test\Place')
            ->andReturn($location)
            ->once();

        Artisan::call('foreman:factory', [
            'model' => 'Test',
            '-N' => 'Test\Place'
        ]);
    }
}
