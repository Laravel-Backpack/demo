<?php

namespace Tests\Feature\Admin\PetShop;

use App\Http\Controllers\Admin\PetShop\OwnerPetsCrudController;

class OwnerPetsCrudControllerTest extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = OwnerPetsCrudController::class;
    public string $model = \App\Models\PetShop\Pet::class;
    public string $route = 'owner-pets';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = ['owner' => 1]; 
}
