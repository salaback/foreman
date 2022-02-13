<?php

namespace Alablaster\Foreman\Tests;

use Alablaster\Foreman\Facades\Location;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Alablaster\Foreman\Facades\Foreman;
use Alablaster\Foreman\Traits\InteractsWithFilesTrait;

class RequestGeneratorTest extends TestCase
{
    use WithFaker;
    use InteractsWithFilesTrait;

    public function test_generatesModelFile()
    {
        $model = 'Test';
        $location = base_path("tests/scratch/CreateTestRequest.php");
        $namespace = "Test\Test";

        Location::shouldReceive('request')
            ->with($model, $namespace, 'create', null)
            ->andReturn($location);

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Foreman::requests($model, $namespace, 'create', null);

        $this->assertFileExists($location);

        $this->deleteFile($location);
    }

    public function test_with2LevelNamespace()
    {
        $model = 'Test';
        $location = base_path("tests/scratch/CreateTestRequest.php");
        $namespace = "Test\Test";

        Location::shouldReceive('request')
            ->with($model, 'create', $namespace, null)
            ->andReturn($location);

        config(['foreman' => [ 'base-namespace' => 'Intellicoreltd\Package']]);

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Foreman::requests($model, 'create', $namespace,null);

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

        Location::shouldReceive('request')
            ->with($model, 'create', $namespace, null)
            ->andReturn($location);

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Foreman::requests($model, 'create', $namespace);

        $this->assertStringContainsString(
            "class CreateTestRequest extends FormRequest",
            $this->openFile($location)
        );

        $this->deleteFile($location);
    }

    public function test_allBracesFulfilled()
    {
        $model = 'Test';
        $location = base_path("tests/scratch/Test.php");
        $namespace = "Test\Test";

        Location::shouldReceive('request')
            ->with($model, 'create', $namespace, null)
            ->andReturn($location);


        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Foreman::requests($model, 'create', $namespace);

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
