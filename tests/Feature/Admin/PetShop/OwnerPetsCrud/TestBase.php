<?php

namespace Tests\Feature\Admin\PetShop\OwnerPetsCrud;

use App\Http\Controllers\Admin\PetShop\OwnerPetsCrudController;
use App\Models\PetShop\Pet;

/**
 * NOTE: This test configuration was generated using naming conventions because
 * the CrudController could not be initialized. Please verify that the model,
 * route, and controller values below are correct before running your tests.
 */
class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = OwnerPetsCrudController::class;
    public string $model = Pet::class;
    public string $route = 'pet-shop/owner/1/pets';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = []; 


    public function setUp(): void
    {
        parent::setUp();
        // ensure we have an owner in the database
        \App\Models\PetShop\Owner::factory()->create();
    }
    
}
