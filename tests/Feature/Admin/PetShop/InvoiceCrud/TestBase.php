<?php

namespace Tests\Feature\Admin\PetShop\InvoiceCrud;

use App\Http\Controllers\Admin\PetShop\InvoiceCrudController;
use App\Models\PetShop\Invoice;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = InvoiceCrudController::class;
    public string $model = Invoice::class;
    public string $route = 'pet-shop/invoice';
    public ?string $entityName = 'invoice';
    public ?string $entityNamePlural = 'invoices';
}
