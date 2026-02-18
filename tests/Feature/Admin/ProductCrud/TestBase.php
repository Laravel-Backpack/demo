<?php

namespace Tests\Feature\Admin\ProductCrud;

use App\Http\Controllers\Admin\ProductCrudController;
use App\Models\Product;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = ProductCrudController::class;
    public string $model = Product::class;
    public string $route = 'product';
    public ?string $entityName = 'product';
    public ?string $entityNamePlural = 'products';
}
