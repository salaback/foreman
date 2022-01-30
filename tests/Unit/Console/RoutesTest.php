<?php

namespace Intellicoreltd\Generators\Tests\Unit\Console;

use Illuminate\Support\Facades\Artisan;
use Intellicoreltd\Generators\Facades\Generate;
use Intellicoreltd\Generators\Tests\TestCase;

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
