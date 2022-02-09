<?php

namespace Alablaster\Foreman\Tests\Unit\Console;

use Illuminate\Support\Facades\Artisan;
use Alablaster\Foreman\Facades\Foreman;
use Alablaster\Foreman\Tests\TestCase;

class ModelTest extends TestCase
{
    public function test_normal()
    {
        Foreman::shouldReceive('model')
            ->with(base_path() . '/src/Models/Test/Place/Test.php', 'Test', 'Test\Place')
            ->once();

        Artisan::call('foreman:model', [
            'model' => 'Test',
            '-N' => 'Test\Place'
        ]);
    }
}
