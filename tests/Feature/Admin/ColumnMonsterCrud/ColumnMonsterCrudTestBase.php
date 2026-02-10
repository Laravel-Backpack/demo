<?php

namespace Tests\Feature\Admin\ColumnMonsterCrud;

use App\Http\Controllers\Admin\ColumnMonsterCrudController;
use App\Models\Monster;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class ColumnMonsterCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = ColumnMonsterCrudController::class;
    protected string $route = 'column-monster';
    protected string $model = Monster::class;
    protected ?string $entityName = 'column monster';
    protected ?string $entityNamePlural = 'column monsters';
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
