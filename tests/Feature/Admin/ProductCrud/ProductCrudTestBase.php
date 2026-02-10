<?php

namespace Tests\Feature\Admin\ProductCrud;

use App\Http\Controllers\Admin\ProductCrudController;
use App\Models\Product;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class ProductCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = ProductCrudController::class;
    protected string $route = 'product';
    protected string $model = Product::class;
    protected ?string $entityName = 'product';
    protected ?string $entityNamePlural = 'products';
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
