<?php

namespace Tests\Feature\Admin\PetShop\PassportCrud;

use App\Http\Controllers\Admin\PetShop\PassportCrudController;
use App\Models\PetShop\Passport;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = PassportCrudController::class;
    public string $model = Passport::class;
    public string $route = 'pet-shop/passport';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = [];
}
