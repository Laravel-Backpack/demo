<?php

namespace Tests\Feature\Admin\PetShop\OwnerPetsCrud;

use App\Http\Controllers\Admin\PetShop\OwnerPetsCrudController;
use App\Models\PetShop\Pet;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class OwnerPetsCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = OwnerPetsCrudController::class;
    protected string $route = 'pet-shop/owner/1/pets';
    protected string $model = Pet::class;
    protected ?string $entityName = 'pet';
    protected ?string $entityNamePlural = 'pets';
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
