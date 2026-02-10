<?php

namespace Tests\Feature\FluentMonsterCrud;

use App\Http\Controllers\Admin\FluentMonsterCrudController;
use App\Models\Monster;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class FluentMonsterCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = FluentMonsterCrudController::class;
    protected string $route = 'fluent-monster';
    protected string $model = Monster::class;
    protected ?string $entityName = 'fluent monster';
    protected ?string $entityNamePlural = 'fluent monsters';
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
