<?php

namespace Tests\Feature\Admin;

use App\Http\Controllers\Admin\ColumnMonsterCrudController;

class ColumnMonsterCrudControllerTest extends MonsterCrudControllerTest
{
    public string $controller = ColumnMonsterCrudController::class;
    public string $route = 'column-monster';
}
