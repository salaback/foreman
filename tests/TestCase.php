<?php

namespace Intellicoreltd\Generators\Tests;

use Intellicoreltd\Generators\GeneratorsServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{

    protected function getPackageProviders($app): array
    {
        return [
            GeneratorsServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {

    }
}
