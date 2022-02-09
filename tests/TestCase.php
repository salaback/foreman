<?php

namespace Alablaster\Foreman\Tests;

use Alablaster\Foreman\ForemanServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{

    protected function getPackageProviders($app): array
    {
        return [
            ForemanServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {

    }
}
