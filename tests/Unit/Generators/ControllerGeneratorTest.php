<?php

namespace Alablaster\Generators\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Alablaster\Generators\Facades\Generate;
use Alablaster\Generators\Traits\InteractsWithFilesTrait;

class ControllerGeneratorTest extends TestCase
{
    use WithFaker;
    use InteractsWithFilesTrait;

    public function test_generatesModelFile()
    {
        $model = Str::studly($this->faker->word);
        $location = base_path("tests/scratch/${model}Controller.php");
        $namespace = "Test\Test";

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Generate::controller($location, $model, $namespace, 'test');

        $this->assertFileExists($location);

        $this->deleteFile($location);
    }

    public function test_with2LevelNamespace()
    {
        $model = Str::studly($this->faker->word);
        $location = base_path("tests/scratch/${model}Controller.php");
        $namespace = "Test\Test";

        config(['generators' => [ 'base-namespace' => 'Intellicoreltd\Package']]);

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Generate::controller($location, $model, $namespace, 'test');

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

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Generate::controller($location, $model, $namespace, 'test');

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

    public function test_withModule()
    {
        $model = "Test";
        $location = base_path("tests/scratch/test.php");
        $namespace = "Test\Test";

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Generate::controller($location, $model, $namespace, 'test');

        $this->assertStringContainsString(
            "->through(config('test.filters.index'))",
            $this->openFile($location)
        );

        $this->deleteFile($location);
    }

    public function test_allBracesFulfilled()
    {
        $model = Str::studly($this->faker->word);
        $location = base_path("tests/scratch/${model}.php");
        $namespace = "Test\Test";

        $this->assertFileDoesNotExist($location);

        Generate::controller($location, $model, $namespace, 'test');

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
