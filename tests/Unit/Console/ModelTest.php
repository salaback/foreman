<?php

namespace Alablaster\Foreman\Tests\Unit\Console;

use Alablaster\Foreman\Facades\Location;
use Illuminate\Support\Facades\Artisan;
use Alablaster\Foreman\Facades\Foreman;
use Alablaster\Foreman\Tests\TestCase;

class ModelTest extends TestCase
{
    public function test_normal()
    {
        $location = '/src/Models/Test/Place/Test.php';

        Foreman::shouldReceive('model')
            ->with($location, 'Test', 'Test\Place')
            ->once();

        Location::shouldReceive('model')
            ->with('Test', 'Test\Place', '')
            ->andReturn($location)
            ->once();

        Artisan::call('foreman:model', [
            'model' => 'Test',
            '-N' => 'Test\Place'
        ]);
    }
}
