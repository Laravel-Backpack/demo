<?php

namespace Tests\Feature\Admin\PetShop;

use App\Http\Controllers\Admin\PetShop\OwnerPetsCrudController;
use App\Models\OwnerPets;

/**
 * NOTE: This test configuration was generated using naming conventions because
 * the CrudController could not be initialized. Please verify that the model,
 * route, and controller values below are correct before running your tests.
 */
class OwnerPetsCrudControllerTest extends \Tests\Feature\Backpack\DefaultTestBase
{
    use \Tests\Feature\Backpack\DefaultCreateTests;
    use \Tests\Feature\Backpack\DefaultUpdateTests;
    use \Tests\Feature\Backpack\DefaultListTests;
    use \Tests\Feature\Backpack\DefaultShowTests;

    public string $controller = OwnerPetsCrudController::class;
    public string $model = OwnerPets::class;
    public string $route = 'owner-pets';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = []; 
}
