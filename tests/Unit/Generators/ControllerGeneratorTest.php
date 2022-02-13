<?php

namespace Alablaster\Foreman\Tests;

use Alablaster\Foreman\Facades\Location;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Alablaster\Foreman\Facades\Foreman;
use Alablaster\Foreman\Traits\InteractsWithFilesTrait;

class ControllerGeneratorTest extends TestCase
{
    use WithFaker;
    use InteractsWithFilesTrait;

    public function test_generatesModelFile()
    {
        $model = 'Test';
        $namespace = "Test\Test";
        $location = base_path('scratch/test.php');

        Location::shouldReceive('controller')
            ->with($model, $namespace, null)
            ->andReturn($location);

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Foreman::controller($model, $namespace);

        $this->assertFileExists($location);

        $this->deleteFile($location);
    }

    public function test_with2LevelNamespace()
    {
        $model = "Test";
        $location = base_path("tests/scratch/TestController.php");
        $namespace = "Test\Test";

        Location::shouldReceive('controller')
            ->with($model, $namespace, null)
            ->andReturn($location);

        config(['foreman' => [ 'base-namespace' => 'Intellicoreltd\Package']]);

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Foreman::controller($model, $namespace);

        $this->assertStringContainsString(
            "namespace Intellicoreltd\Package\Http\Controllers\Test\Test;",
            $this->openFile($location)
        );

        $this->assertStringContainsString(
            "use Intellicoreltd\Package\Models\Test\Test\\${model};",
            $this->openFile($location)
        );

        $this->deleteFile($location);
    }

    public function test_withModelName()
    {
        $model = "Test";
        $location = base_path("tests/scratch/test.php");
        $namespace = "Test\Test";

        Location::shouldReceive('controller')
            ->with($model, $namespace, null)
            ->andReturn($location);

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Foreman::controller($model, $namespace);

        $this->assertStringContainsString(
            "* Return an array of Tests",
            $this->openFile($location)
        );

        $this->assertStringContainsString(
            'public function show(Test $test)',
            $this->openFile($location)
        );

        $this->deleteFile($location);
    }

    public function test_allBracesFulfilled()
    {
        $model = Str::studly($this->faker->word);
        $location = base_path("tests/scratch/${model}.php");
        $namespace = "Test\Test";

        Location::shouldReceive('controller')
            ->with($model, $namespace, null)
            ->andReturn($location);

        $this->assertFileDoesNotExist($location);

        Foreman::controller($model, $namespace);

        $this->assertStringNotContainsString(
            "{{",
            $this->openFile($location)
        );

        $this->assertStringNotContainsString(
            "}}",
            $this->openFile($location)
        );

        $this->deleteFile($location);
    }
}
