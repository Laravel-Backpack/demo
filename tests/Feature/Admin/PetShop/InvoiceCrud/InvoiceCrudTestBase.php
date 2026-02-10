<?php

namespace Tests\Feature\Admin\PetShop\InvoiceCrud;

use App\Http\Controllers\Admin\PetShop\InvoiceCrudController;
use App\Models\PetShop\Invoice;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class InvoiceCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = InvoiceCrudController::class;
    protected string $route = 'pet-shop/invoice';
    protected string $model = Invoice::class;
    protected ?string $entityName = 'invoice';
    protected ?string $entityNamePlural = 'invoices';
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
