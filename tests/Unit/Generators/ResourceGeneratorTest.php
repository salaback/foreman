<?php

namespace Alablaster\Foreman\Tests;

use Alablaster\Foreman\Facades\Location;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Alablaster\Foreman\Facades\Foreman;
use Alablaster\Foreman\Traits\InteractsWithFilesTrait;

class ResourceGeneratorTest extends TestCase
{
    use WithFaker;
    use InteractsWithFilesTrait;

    public function test_generatesModelFile()
    {
        $model = 'Test';
        $location = base_path("tests/scratch/Test.php");
        $namespace = "Test\Test";

        Location::shouldReceive('resource')
            ->with($model, 'Resource', $namespace, null)
            ->andReturn($location);

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Foreman::resource($model, 'Resource', $namespace);

        $this->assertFileExists($location);

        $this->deleteFile($location);
    }

    public function test_with2LevelNamespace()
    {
        $model = 'Test';
        $location = base_path("tests/scratch/Test.php");
        $namespace = "Test\Test";

        Location::shouldReceive('resource')
            ->with($model, 'Resource', $namespace, null)
            ->andReturn($location);

        config(['foreman' => [ 'base-namespace' => 'Intellicoreltd\Package']]);

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Foreman::resource($model, 'Resource', $namespace);

        $this->assertStringContainsString(
            "namespace Intellicoreltd\Package\Http\Resources\Test\Test;",
            $this->openFile($location)
        );

        $this->deleteFile($location);
    }

    public function test_withModelName()
    {
        $model = "TestModel";
        $location = base_path("tests/scratch/test.php");
        $namespace = "Test\Test";

        Location::shouldReceive('resource')
            ->with($model, 'Resource', $namespace, null)
            ->andReturn($location);

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Foreman::resource($model, 'Resource', $namespace);

        $this->assertStringContainsString(
            '"@type" => "TestModel"',
            $this->openFile($location)
        );

        $this->assertStringContainsString(
            '"self" => route("test-model.show", $this)',
            $this->openFile($location)
        );

        $this->deleteFile($location);
    }

    public function test_allBracesFulfilled()
    {
        $model = Str::studly($this->faker->word);
        $location = base_path("tests/scratch/${model}.php");
        $namespace = "Test\Test";

        Location::shouldReceive('resource')
            ->with($model, 'Resource', $namespace, null)
            ->andReturn($location);

        $this->assertFileDoesNotExist($location);

        Foreman::resource($model, 'Resource', $namespace);

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
