<?php

namespace Tests\Feature\Admin\PetShop\PetCrud;

use App\Http\Controllers\Admin\PetShop\PetCrudController;
use App\Models\PetShop\Pet;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class PetCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = PetCrudController::class;
    protected string $route = 'pet-shop/pet';
    protected string $model = Pet::class;
    protected ?string $entityName = 'pet';
    protected ?string $entityNamePlural = 'pets';
    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->testHelper->actingAsAdmin($this);
    }
}
