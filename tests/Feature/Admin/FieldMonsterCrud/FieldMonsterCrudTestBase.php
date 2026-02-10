<?php

namespace Tests\Feature\Admin\FieldMonsterCrud;

use App\Http\Controllers\Admin\FieldMonsterCrudController;
use App\Models\Monster;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class FieldMonsterCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = FieldMonsterCrudController::class;
    protected string $route = 'field-monster';
    protected string $model = Monster::class;
    protected ?string $entityName = 'field monster';
    protected ?string $entityNamePlural = 'field monsters';
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
