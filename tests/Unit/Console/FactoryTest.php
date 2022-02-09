<?php

namespace Alablaster\Foreman\Tests\Unit\Console;

use Illuminate\Support\Facades\Artisan;
use Alablaster\Foreman\Facades\Foreman;
use Alablaster\Foreman\Tests\TestCase;

class FactoryTest extends TestCase
{
    public function test_normal()
    {
        Foreman::shouldReceive('factory')
            ->with(base_path('database/factories/Test/Place/TestFactory.php'), 'Test', 'Test\Place')
            ->once();

        Artisan::call('foreman:factory', [
            'model' => 'Test',
            '-N' => 'Test\Place'
        ]);
    }
}
