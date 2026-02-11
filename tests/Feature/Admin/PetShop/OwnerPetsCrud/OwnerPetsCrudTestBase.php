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
        $this->testHelper->actingAsAdmin($this);
    }
}
