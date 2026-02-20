<?php

namespace Tests\Feature\Admin\ColumnMonsterCrud;

use App\Http\Controllers\Admin\ColumnMonsterCrudController;
use App\Models\Monster;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = ColumnMonsterCrudController::class;
    public string $model = Monster::class;
    public string $route = 'column-monster';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = []; 
}
