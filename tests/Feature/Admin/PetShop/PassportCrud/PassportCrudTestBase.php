<?php

namespace Tests\Feature\Admin\PetShop\PassportCrud;

use App\Http\Controllers\Admin\PetShop\PassportCrudController;
use App\Models\PetShop\Passport;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class PassportCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = PassportCrudController::class;
    protected string $route = 'pet-shop/passport';
    protected string $model = Passport::class;
    protected ?string $entityName = 'passport';
    protected ?string $entityNamePlural = 'passports';
    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->testHelper->actingAsAdmin($this);
    }
}
