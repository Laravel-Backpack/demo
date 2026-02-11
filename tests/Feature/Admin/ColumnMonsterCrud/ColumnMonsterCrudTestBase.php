<?php

namespace Tests\Feature\Admin\ColumnMonsterCrud;

use App\Http\Controllers\Admin\ColumnMonsterCrudController;
use App\Models\Monster;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class ColumnMonsterCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = ColumnMonsterCrudController::class;
    protected string $route = 'column-monster';
    protected string $model = Monster::class;
    protected ?string $entityName = 'column monster';
    protected ?string $entityNamePlural = 'column monsters';
    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->testHelper->actingAsAdmin($this);
    }
}
