<?php

namespace Tests\Feature\Admin\PetShop\OwnerCrud;

use App\Http\Controllers\Admin\PetShop\OwnerCrudController;
use App\Models\PetShop\Owner;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = OwnerCrudController::class;
    public string $model = Owner::class;
    public string $route = 'pet-shop/owner';
    public ?string $entityName = 'owner';
    public ?string $entityNamePlural = 'owners';
}
