<?php

namespace Alablaster\Foreman\Tests\Unit\Console;

use Illuminate\Support\Facades\Artisan;
use Alablaster\Foreman\Facades\Foreman;
use Alablaster\Foreman\Tests\TestCase;

class RoutesTest extends TestCase
{
    public function test_normal()
    {
        Foreman::shouldReceive('route')
            ->with(base_path() . '/routes/api.php', 'Test', 'Test\Place', 'test')
            ->once();

        Artisan::call('foreman:route', [
            'model' => 'Test',
            '-N' => 'Test\Place',
            '-D' => 'test'
        ]);
    }
}
