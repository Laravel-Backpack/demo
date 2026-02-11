<?php

namespace Tests\Feature\Admin\FieldMonsterCrud;

use App\Http\Controllers\Admin\FieldMonsterCrudController;
use App\Models\Monster;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class FieldMonsterCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = FieldMonsterCrudController::class;
    protected string $route = 'field-monster';
    protected string $model = Monster::class;
    protected ?string $entityName = 'field monster';
    protected ?string $entityNamePlural = 'field monsters';
    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->testHelper->actingAsAdmin($this);
    }
}
