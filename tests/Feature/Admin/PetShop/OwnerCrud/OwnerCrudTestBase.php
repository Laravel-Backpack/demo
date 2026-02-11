<?php

namespace Tests\Feature\Admin\PetShop\OwnerCrud;

use App\Http\Controllers\Admin\PetShop\OwnerCrudController;
use App\Models\PetShop\Owner;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class OwnerCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = OwnerCrudController::class;
    protected string $route = 'pet-shop/owner';
    protected string $model = Owner::class;
    protected ?string $entityName = 'owner';
    protected ?string $entityNamePlural = 'owners';
    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->testHelper->actingAsAdmin($this);
    }
}
