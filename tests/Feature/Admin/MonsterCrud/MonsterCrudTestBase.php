<?php

namespace Tests\Feature\Admin\MonsterCrud;

use App\Http\Controllers\Admin\MonsterCrudController;
use App\Models\Monster;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class MonsterCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = MonsterCrudController::class;
    protected string $route = 'monster';
    protected string $model = Monster::class;
    protected ?string $entityName = 'monster';
    protected ?string $entityNamePlural = 'monsters';
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
