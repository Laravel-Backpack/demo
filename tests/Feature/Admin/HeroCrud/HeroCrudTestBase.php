<?php

namespace Tests\Feature\Admin\HeroCrud;

use App\Http\Controllers\Admin\HeroCrudController;
use App\Models\Hero;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class HeroCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = HeroCrudController::class;
    protected string $route = 'hero';
    protected string $model = Hero::class;
    protected ?string $entityName = 'hero';
    protected ?string $entityNamePlural = 'heroes';
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
