<?php

namespace Tests\Feature\Admin\PetShop\PassportCrud;

use App\Http\Controllers\Admin\PetShop\PassportCrudController;
use App\Models\PetShop\Passport;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = PassportCrudController::class;
    public string $model = Passport::class;
    public string $route = 'pet-shop/passport';
    public ?string $entityName = 'passport';
    public ?string $entityNamePlural = 'passports';
}
