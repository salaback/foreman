<?php

namespace Alablaster\Foreman\Tests\Unit\Console;

use Alablaster\Foreman\Facades\Location;
use Illuminate\Support\Facades\Artisan;
use Alablaster\Foreman\Facades\Foreman;
use Alablaster\Foreman\Tests\TestCase;

class ControllerTest extends TestCase
{
    public function test_normal()
    {
        $location = '/src/Http/Controllers/Test/Place/TestController.php';

        Foreman::shouldReceive('controller')
            ->with($location , 'Test', 'Test\Place', 'test')
            ->once();

        Location::shouldReceive('controller')
            ->with('Test', 'Test\Place', '', 'test')
            ->andReturn($location)
            ->once();

        Artisan::call('foreman:controller', [
            'model' => 'Test',
            '-N' => 'Test\Place',
            '-M' => 'test'
        ]);
    }
}
