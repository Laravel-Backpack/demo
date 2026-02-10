<?php

namespace Tests\Feature\Admin\IconCrud;

use App\Http\Controllers\Admin\IconCrudController;
use App\Models\Icon;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class IconCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = IconCrudController::class;
    protected string $route = 'icon';
    protected string $model = Icon::class;
    protected ?string $entityName = 'icon';
    protected ?string $entityNamePlural = 'icons';
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
