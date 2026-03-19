<?php

namespace Tests\Feature\Admin;

use App\Http\Controllers\Admin\FieldMonsterCrudController;

class FieldMonsterCrudControllerTest extends MonsterCrudControllerTest
{
    public string $controller = FieldMonsterCrudController::class;
    public string $route = 'field-monster';
}
