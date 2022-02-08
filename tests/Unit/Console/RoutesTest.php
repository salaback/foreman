<?php

namespace Alablaster\Generators\Tests\Unit\Console;

use Illuminate\Support\Facades\Artisan;
use Alablaster\Generators\Facades\Generate;
use Alablaster\Generators\Tests\TestCase;

class RoutesTest extends TestCase
{
    public function test_normal()
    {
        Generate::shouldReceive('route')
            ->with(base_path() . '/routes/api.php', 'Test', 'Test\Place', 'test')
            ->once();

        Artisan::call('generate:route', [
            'model' => 'Test',
            '-N' => 'Test\Place',
            '-M' => 'test'
        ]);
    }
}
