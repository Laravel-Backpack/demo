<?php

namespace Tests\Feature\Admin;

use App\Http\Controllers\Admin\FluentMonsterCrudController;

class FluentMonsterCrudControllerTest extends MonsterCrudControllerTest
{
    public string $controller = FluentMonsterCrudController::class;
    public string $route = 'fluent-monster';
}
