<?php

namespace Alablaster\Foreman\Tests\Unit\Console;

use Illuminate\Support\Facades\Artisan;
use Alablaster\Foreman\Facades\Foreman;
use Alablaster\Foreman\Tests\TestCase;

class RequestTest extends TestCase
{
    public function test_normal()
    {

        Foreman::shouldReceive('requests')
            ->with(base_path('src/Http/Requests/Test/Place/CreateTestRequest.php'), 'Test', 'Test\Place', 'create');

        Foreman::shouldReceive('requests')
            ->with(base_path('src/Http/Requests/Test/Place/UpdateTestRequest.php'), 'Test', 'Test\Place', 'update');

        Artisan::call('foreman:requests', [
            'model' => 'Test',
            '-N' => 'Test\Place',
        ]);
    }
}
