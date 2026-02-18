<?php

namespace Tests\Feature\Admin\PetShop\OwnerPetsCrud;

use App\Http\Controllers\Admin\PetShop\OwnerPetsCrudController;
use App\Models\PetShop\Pet;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = OwnerPetsCrudController::class;
    public string $model = Pet::class;
    public string $route = 'pet-shop/owner/1/pets';
    public ?string $entityName = 'pet';
    public ?string $entityNamePlural = 'pets';

     public function setUp(): void
    {
        parent::setUp();

        // ensure we have an owner in the database
        \App\Models\PetShop\Owner::factory()->create();
    }
}
