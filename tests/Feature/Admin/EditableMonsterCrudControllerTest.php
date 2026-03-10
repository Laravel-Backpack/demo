<?php

namespace Tests\Feature\Admin;

use App\Http\Controllers\Admin\EditableMonsterCrudController;

class EditableMonsterCrudControllerTest extends MonsterCrudControllerTest
{
    public string $controller = EditableMonsterCrudController::class;
    public string $route = 'editable-monster';
}
