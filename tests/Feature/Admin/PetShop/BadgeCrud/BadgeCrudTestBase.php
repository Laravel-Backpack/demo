<?php

namespace Tests\Feature\Admin\PetShop\BadgeCrud;

use App\Http\Controllers\Admin\PetShop\BadgeCrudController;
use App\Models\PetShop\Badge;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class BadgeCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = BadgeCrudController::class;
    protected string $route = 'pet-shop/badge';
    protected string $model = Badge::class;
    protected ?string $entityName = 'badge';
    protected ?string $entityNamePlural = 'badges';
    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->testHelper->actingAsAdmin($this);
    }
}
