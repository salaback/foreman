<?php

namespace Alablaster\Foreman\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Alablaster\Foreman\Facades\Generate;
use Alablaster\Foreman\Traits\InteractsWithFilesTrait;

class RouteGeneratorTest extends TestCase
{
    use WithFaker;
    use InteractsWithFilesTrait;

    public function test_generatesModelFile_fromScratch()
    {
        $model = Str::studly($this->faker->word);
        $location = base_path("tests/scratch/routes.php");
        $namespace = "Test\Test";

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Generate::route($location, $model, $namespace, 'test');

        $this->assertFileExists($location);

        $this->deleteFile($location);
    }

    public function test_addsRouteToFile_newRouteForExistingModule()
    {
        $model = 'FirstModel';
        $location = base_path("tests/scratch/routes.php");
        $namespace = "Test\Test";

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Generate::route($location, $model, $namespace, 'test');

        $model = 'SecondModel';

        $this->assertFileExists($location);

        $this->assertStringNotContainsString(
            "/second-model' => SecondModelController::class",
            $this->openFile($location)
        );

        Generate::route($location, $model, $namespace, 'test');

        $this->assertStringContainsString(
            "/second-model' => SecondModelController::class",
            $this->openFile($location)
        );

        $this->deleteFile($location);
    }

    public function test_addsRouteToFile_newRouteForNewModule()
    {
        $model = 'FirstModel';
        $location = base_path("tests/scratch/routes.php");
        $namespace = "Test\Test";

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Generate::route($location, $model, $namespace, 'test');

        $model = 'SecondModel';

        $this->assertFileExists($location);

        $this->assertStringNotContainsString(
            "Route::prefix('api/v1/other-test')->middleware(['bindings'])->group(function() {",
            $this->openFile($location)
        );

        $this->assertStringNotContainsString(
            "Route::prefix('api/v1/other-test')->middleware(['bindings'])->group(function() {",
            $this->openFile($location)
        );

        Generate::route($location, $model, $namespace, 'other-test');

        $this->assertStringContainsString(
            "Route::prefix('api/v1/other-test')->middleware(['bindings'])->group(function() {",
            $this->openFile($location)
        );

        $this->assertStringContainsString(
            "'/second-model' => SecondModelController::class,\n",
            $this->openFile($location)
        );

        $this->deleteFile($location);
    }

    public function test_with2LevelNamespace_fromScratch()
    {
        $model = 'Test';
        $location = base_path("tests/scratch/routes.php");
        $namespace = "Test\Test";

        config(['generators' => [ 'base-namespace' => 'Intellicoreltd\Package']]);

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Generate::route($location, $model, $namespace, 'test');

        $this->assertStringContainsString(
            "use Intellicoreltd\Package\Http\Controllers\Test\Test\TestController;",
            $this->openFile($location)
        );

        $this->deleteFile($location);
    }

    public function test_withModelName_fromScratch()
    {
        $model = "TestModel";
        $location = base_path("tests/scratch/test.php");
        $namespace = "Test\Test";

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Generate::route($location, $model, $namespace, 'test');

        $this->assertStringContainsString(
            "        '/test-model' => TestModelController::class,",
            $this->openFile($location)
        );

        $this->deleteFile($location);
    }

    public function test_withModule_fromScratch()
    {
        $model = "Test";
        $location = base_path("tests/scratch/test.php");
        $namespace = "Test\Test";

        $this->deleteFile($location);
        $this->assertFileDoesNotExist($location);

        Generate::route($location, $model, $namespace, 'test');

        $this->assertStringContainsString(
            "Route::prefix('api/v1/test')->middleware(['bindings'])->group(function() {",
            $this->openFile($location)
        );

        $this->deleteFile($location);
    }

    public function test_allBracesFulfilled_fromScratch()
    {
        $model = Str::studly($this->faker->word);
        $location = base_path("tests/scratch/${model}.php");
        $namespace = "Test\Test";

        $this->assertFileDoesNotExist($location);

        Generate::route($location, $model, $namespace, 'test');

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
