<?php

namespace Tests\Feature\Admin\EditableMonsterCrud;

use App\Http\Controllers\Admin\EditableMonsterCrudController;
use App\Models\Monster;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = EditableMonsterCrudController::class;
    public string $model = Monster::class;
    public string $route = 'editable-monster';
    public ?string $entityName = 'editable monster';
    public ?string $entityNamePlural = 'editable monsters';
}
