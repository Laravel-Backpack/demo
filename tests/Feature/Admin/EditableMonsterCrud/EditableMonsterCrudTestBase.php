<?php

namespace Tests\Feature\Admin\EditableMonsterCrud;

use App\Http\Controllers\Admin\EditableMonsterCrudController;
use App\Models\Monster;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class EditableMonsterCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = EditableMonsterCrudController::class;
    protected string $route = 'editable-monster';
    protected string $model = Monster::class;
    protected ?string $entityName = 'editable monster';
    protected ?string $entityNamePlural = 'editable monsters';
    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->testHelper->actingAsAdmin($this);
    }
}
