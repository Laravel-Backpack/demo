<?php

namespace Tests\Feature\Admin\CaveCrud;

use App\Http\Controllers\Admin\CaveCrudController;
use App\Models\Cave;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class CaveCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = CaveCrudController::class;
    protected string $route = 'cave';
    protected string $model = Cave::class;
    protected ?string $entityName = 'cave';
    protected ?string $entityNamePlural = 'caves';
    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->testHelper->actingAsAdmin($this);
    }
}
