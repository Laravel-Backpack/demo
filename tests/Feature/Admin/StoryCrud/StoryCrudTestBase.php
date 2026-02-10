<?php

namespace Tests\Feature\Admin\StoryCrud;

use App\Http\Controllers\Admin\StoryCrudController;
use App\Models\Story;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class StoryCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = StoryCrudController::class;
    protected string $route = 'story';
    protected string $model = Story::class;
    protected ?string $entityName = 'story';
    protected ?string $entityNamePlural = 'stories';
    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAsAdmin();

        // Clear filters to avoid duplication conflict when the request is run
        if ($this->app->bound('crud')) {
            $this->app['crud']->clearFilters();
        }

        if (config('backpack.testing.configurations.'.$this->controller)) {
            $this->testConfig = new (config('backpack.testing.configurations.'.$this->controller))();
        }
    }
}
