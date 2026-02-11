<?php

namespace Tests\Feature\Admin\MonsterCrud;

use App\Http\Controllers\Admin\MonsterCrudController;
use App\Models\Monster;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class MonsterCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = MonsterCrudController::class;
    protected string $route = 'monster';
    protected string $model = Monster::class;
    protected ?string $entityName = 'monster';
    protected ?string $entityNamePlural = 'monsters';
    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->testHelper->actingAsAdmin($this);
    }
}
