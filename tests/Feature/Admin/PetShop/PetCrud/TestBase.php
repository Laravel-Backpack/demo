<?php

namespace Tests\Feature\Admin\PetShop\PetCrud;

use App\Http\Controllers\Admin\PetShop\PetCrudController;
use App\Models\PetShop\Pet;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = PetCrudController::class;
    public string $model = Pet::class;
    public string $route = 'pet-shop/pet';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = [];
}
