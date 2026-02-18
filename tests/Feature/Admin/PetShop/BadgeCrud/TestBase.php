<?php

namespace Tests\Feature\Admin\PetShop\BadgeCrud;

use App\Http\Controllers\Admin\PetShop\BadgeCrudController;
use App\Models\PetShop\Badge;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = BadgeCrudController::class;
    public string $model = Badge::class;
    public string $route = 'pet-shop/badge';
    public ?string $entityName = 'badge';
    public ?string $entityNamePlural = 'badges';
}
