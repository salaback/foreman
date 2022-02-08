<?php

namespace Alablaster\Foreman\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Alablaster\Foreman\Facades\Generate;
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

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Generate::resource($location, $model, $namespace);

        $this->assertFileExists($location);

        $this->deleteFile($location);
    }

    public function test_with2LevelNamespace()
    {
        $model = 'Test';
        $location = base_path("tests/scratch/Test.php");
        $namespace = "Test\Test";

        config(['generators' => [ 'base-namespace' => 'Intellicoreltd\Package']]);

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Generate::resource($location, $model, $namespace, 'test');

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

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Generate::resource($location, $model, $namespace, 'test');

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

        $this->assertFileDoesNotExist($location);

        Generate::resource($location, $model, $namespace);

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
