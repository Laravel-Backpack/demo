<?php

namespace Tests\Feature\Admin;

use App\Http\Controllers\Admin\ProductCrudController;
use App\Models\Product;

class ProductCrudControllerTest extends \Tests\Feature\Backpack\DefaultTestBase
{
    use \Tests\Feature\Backpack\DefaultListTests;
    use \Tests\Feature\Backpack\DefaultCreateTests;
    use \Tests\Feature\Backpack\DefaultUpdateTests;
    use \Tests\Feature\Backpack\DefaultDeleteTests;

    public string $controller = ProductCrudController::class;
    public string $model = Product::class;
    public string $route = 'product';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = []; 
}
