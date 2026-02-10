<?php

namespace Tests\Feature\Admin\DummyCrud;

use App\Http\Controllers\Admin\DummyCrudController;
use App\Models\Dummy;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class DummyCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = DummyCrudController::class;
    protected string $route = 'dummy';
    protected string $model = Dummy::class;
    protected ?string $entityName = 'dummy';
    protected ?string $entityNamePlural = 'dummies';
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
