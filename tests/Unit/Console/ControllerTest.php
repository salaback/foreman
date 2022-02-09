<?php

namespace Alablaster\Foreman\Tests\Unit\Console;

use Illuminate\Support\Facades\Artisan;
use Alablaster\Foreman\Facades\Foreman;
use Alablaster\Foreman\Tests\TestCase;

class ControllerTest extends TestCase
{
    public function test_normal()
    {
        Foreman::shouldReceive('controller')
            ->with(base_path() . '/src/Http/Controllers/Test/Place/TestController.php', 'Test', 'Test\Place', 'test')
            ->once();

        Artisan::call('foreman:controller', [
            'model' => 'Test',
            '-N' => 'Test\Place',
            '-M' => 'test'
        ]);
    }
}
