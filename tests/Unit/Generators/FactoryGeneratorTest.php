<?php

namespace Alablaster\Foreman\Tests;

use Alablaster\Foreman\Facades\Location;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Alablaster\Foreman\Facades\Foreman;
use Alablaster\Foreman\Traits\InteractsWithFilesTrait;

class FactoryGeneratorTest extends TestCase
{
    use WithFaker;
    use InteractsWithFilesTrait;

    public function test_generatesModelFile()
    {
        $model = Str::studly($this->faker->word);
        $location = base_path("tests/scratch/${model}.php");
        $namespace = "Test\Test";

        Location::shouldReceive('factory')
            ->with($model, $namespace)
            ->andReturn($location);

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Foreman::factory($model, $namespace);

        $this->assertFileExists($location);

        $this->deleteFile($location);
    }

    public function test_with2LevelNamespace()
    {
        $model = 'Test';
        $location = base_path("tests/scratch/${model}.php");
        $namespace = "Test\Test";

        Location::shouldReceive('factory')
            ->with($model, $namespace)
            ->andReturn($location);

        config(['foreman' => [ 'base-namespace' => 'Intellicoreltd\Package']]);

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Foreman::factory($model, $namespace);

        $this->assertStringContainsString(
            "namespace Intellicoreltd\Package\Database\Factories\Test\Test;",
            $this->openFile($location)
        );

        $this->deleteFile($location);
    }

    public function test_withModelName()
    {
        $model = "Test";
        $location = base_path("tests/scratch/${model}.php");
        $namespace = "Test\Test";

        Location::shouldReceive('factory')
            ->with($model, $namespace)
            ->andReturn($location);

        config(['foreman' => [ 'base-namespace' => 'Intellicoreltd\Package']]);

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Foreman::factory($model, $namespace);

        $this->assertStringContainsString(
            "class TestFactory extends Factory",
            $this->openFile($location)
        );

        $this->assertStringContainsString(
            "use Intellicoreltd\Package\Models\Test\Test\Test;",
            $this->openFile($location)
        );

        $this->deleteFile($location);
    }

    public function test_allBracesFulfilled()
    {
        $model = Str::studly($this->faker->word);
        $location = base_path("tests/scratch/${model}.php");
        $namespace = "Test\Test";

        Location::shouldReceive('factory')
            ->with($model, $namespace)
            ->andReturn($location);

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Foreman::factory($model, $namespace);

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
