<?php

namespace Alablaster\Foreman\Tests\Unit\Console;

use Illuminate\Support\Facades\Artisan;
use Alablaster\Foreman\Facades\Generate;
use Alablaster\Foreman\Tests\TestCase;

class FactoryTest extends TestCase
{
    public function test_normal()
    {
        Generate::shouldReceive('factory')
            ->with(base_path() . '/database/factories/Test/Place/TestFactory.php', 'Test', 'Test\Place')
            ->once();

        Artisan::call('generate:factory', [
            'model' => 'Test',
            '-N' => 'Test\Place'
        ]);
    }
}
