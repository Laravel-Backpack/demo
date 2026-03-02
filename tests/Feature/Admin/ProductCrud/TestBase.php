<?php

namespace Tests\Feature\Admin\ProductCrud;

use App\Http\Controllers\Admin\ProductCrudController;
use App\Models\Product;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = ProductCrudController::class;
    public string $model = Product::class;
    public string $route = 'product';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = [];
}
