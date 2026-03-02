<?php

namespace Tests\Feature\Admin\PetShop\InvoiceCrud;

use App\Http\Controllers\Admin\PetShop\InvoiceCrudController;
use App\Models\PetShop\Invoice;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = InvoiceCrudController::class;
    public string $model = Invoice::class;
    public string $route = 'pet-shop/invoice';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = [];
}
