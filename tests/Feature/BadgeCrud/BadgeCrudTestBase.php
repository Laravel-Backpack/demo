<?php

namespace Tests\Feature\BadgeCrud;

use App\Http\Controllers\Admin\PetShop\BadgeCrudController;
use App\Models\PetShop\Badge;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class BadgeCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = BadgeCrudController::class;
    protected string $route = 'pet-shop/badge';
    protected string $model = Badge::class;
    protected ?string $entityName = 'badge';
    protected ?string $entityNamePlural = 'badges';
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
