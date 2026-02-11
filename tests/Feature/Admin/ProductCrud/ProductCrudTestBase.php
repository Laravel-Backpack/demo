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
        $this->testHelper->actingAsAdmin($this);
    }
}
