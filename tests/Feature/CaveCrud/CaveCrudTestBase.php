<?php

namespace Tests\Feature\CaveCrud;

use App\Http\Controllers\Admin\CaveCrudController;
use App\Models\Cave;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class CaveCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = CaveCrudController::class;
    protected string $route = 'cave';
    protected string $model = Cave::class;
    protected ?string $entityName = 'cave';
    protected ?string $entityNamePlural = 'caves';
    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAsAdmin();

        // Clear filters to avoid duplication conflict when the request is run
        if ($this->app->bound('crud')) {
            $this->app['crud']->clearFilters();
        }

        if(config('backpack.testing.configurations.'.$this->controller)) {
            $this->testConfig = new (config('backpack.testing.configurations.'.$this->controller))();
        }
    }
}
