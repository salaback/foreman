<?php

namespace Alablaster\Foreman\Tests;

use Alablaster\Foreman\Facades\Location;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Alablaster\Foreman\Facades\Foreman;
use Alablaster\Foreman\Traits\InteractsWithFilesTrait;

class MigrationGeneratorTest extends TestCase
{
    use WithFaker;
    use InteractsWithFilesTrait;

    public function test_generatesMigrationFile()
    {
        $model = Str::studly($this->faker->word);
        $location = base_path("tests/scratch/${model}.php");
        $this->deleteFile($location);

        Location::shouldReceive('migration')
            ->with($model)
            ->andReturn($location);

        $this->assertFileDoesNotExist($location);

        Foreman::migration($model);

        $this->assertFileExists($location);

        $this->deleteFile($location);
    }

    public function test_withModelName()
    {
        $model = "Test";
        $location = base_path("tests/scratch/${model}.php");

        Location::shouldReceive('migration')
            ->with($model)
            ->andReturn($location);

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Foreman::migration($model);

        $this->assertStringContainsString(
            "class CreateTestsTable extends Migration",
            $this->openFile($location)
        );

        $this->assertStringContainsString(
            'Schema::create(\'tests\', function (Blueprint $table) ',
            $this->openFile($location)
        );

        $this->deleteFile($location);
    }

    public function test_allBracesFulfilled()
    {
        $model = Str::studly($this->faker->word);
        $location = base_path("tests/scratch/${model}.php");

        Location::shouldReceive('migration')
            ->with($model)
            ->andReturn($location);

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Foreman::migration($model);

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
