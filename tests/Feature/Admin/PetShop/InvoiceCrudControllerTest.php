<?php

namespace Tests\Feature\Admin\PetShop;

use App\Http\Controllers\Admin\PetShop\InvoiceCrudController;
use App\Models\PetShop\Invoice;

class InvoiceCrudControllerTest extends \Tests\Feature\Backpack\DefaultTestBase
{
    use \Tests\Feature\Backpack\DefaultListTests;
    use \Tests\Feature\Backpack\DefaultShowTests;

    public string $controller = InvoiceCrudController::class;
    public string $model = Invoice::class;
    public string $route = 'pet-shop/invoice';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = []; 
}
