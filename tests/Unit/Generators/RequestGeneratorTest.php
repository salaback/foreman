<?php

namespace Alablaster\Generators\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Alablaster\Generators\Facades\Generate;
use Alablaster\Generators\Traits\InteractsWithFilesTrait;

class RequestGeneratorTest extends TestCase
{
    use WithFaker;
    use InteractsWithFilesTrait;

    public function test_generatesModelFile()
    {
        $model = 'Test';
        $location = base_path("tests/scratch/CreateTestRequest.php");
        $namespace = "Test\Test";

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Generate::requests($location, $model, $namespace, 'create');

        $this->assertFileExists($location);

        $this->deleteFile($location);
    }

    public function test_with2LevelNamespace()
    {
        $model = 'Test';
        $location = base_path("tests/scratch/CreateTestRequest.php");
        $namespace = "Test\Test";

        config(['generators' => [ 'base-namespace' => 'Intellicoreltd\Package']]);

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Generate::requests($location, $model, $namespace, 'create');

        $this->assertStringContainsString(
            "namespace Intellicoreltd\Package\Http\Requests\Test\Test;",
            $this->openFile($location)
        );

        $this->deleteFile($location);
    }

    public function test_withModelName()
    {
        $model = 'Test';
        $location = base_path("tests/scratch/CreateTestRequest.php");
        $namespace = "Test\Test";

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Generate::requests($location, $model, $namespace, 'create');

        $this->assertStringContainsString(
            "class CreateTestRequest extends FormRequest",
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

        Generate::requests($location, $model, $namespace, 'create');

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