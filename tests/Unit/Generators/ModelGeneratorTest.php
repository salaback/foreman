<?php

namespace Alablaster\Generators\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Alablaster\Generators\Facades\Generate;
use Alablaster\Generators\Traits\InteractsWithFilesTrait;

class ModelGeneratorTest extends TestCase
{
    use WithFaker;
    use InteractsWithFilesTrait;

    public function test_generatesModelFile()
    {
        $model = Str::studly($this->faker->word);
        $location = base_path("tests/scratch/${model}.php");
        $namespace = "Test\Test";

        $this->assertFileDoesNotExist($location);

        Generate::model($location, $model, $namespace);

        $this->assertFileExists($location);

        $this->deleteFile($location);
    }

    public function test_with2LevelNamespace()
    {
        $model = Str::studly($this->faker->word);
        $location = base_path("tests/scratch/${model}.php");
        $namespace = "Test\Test";

        config(['generators' => [ 'base-namespace' => 'Intellicoreltd\Package']]);

        $this->assertFileDoesNotExist($location);

        Generate::model($location, $model, $namespace);

        $this->assertStringContainsString(
            "namespace Intellicoreltd\Package\Models\Test\Test;",
            $this->openFile($location)
        );

        $this->assertStringContainsString(
            "use Intellicoreltd\Package\Database\Factories\\${model}Factory;",
            $this->openFile($location)
        );

        $this->deleteFile($location);
    }

    public function test_withModelName()
    {
        $model = Str::studly($this->faker->word);
        $location = base_path("tests/scratch/${model}.php");
        $namespace = "Test\Test";

        $this->assertFileDoesNotExist($location);

        Generate::model($location, $model, $namespace);

        $this->assertStringContainsString(
            "class ${model} extends Model",
            $this->openFile($location)
        );

        $this->assertStringContainsString(
            "${model}Factory",
            $this->openFile($location)
        );

        $this->deleteFile($location);
    }

    public function test_allBracesFulfilled()
    {
        $model = Str::studly($this->faker->word);
        $location = base_path("tests/scratch/${model}.php");
        $namespace = "Test\Test";

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Generate::model($location, $model, $namespace);

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
