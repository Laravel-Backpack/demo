<?php

namespace Tests\Feature\Admin\FluentMonsterCrud;

use App\Http\Controllers\Admin\FluentMonsterCrudController;
use App\Models\Monster;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = FluentMonsterCrudController::class;
    public string $model = Monster::class;
    public string $route = 'fluent-monster';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = []; 
}
