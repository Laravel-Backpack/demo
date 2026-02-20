<?php

namespace Tests\Feature\Admin\FieldMonsterCrud;

use App\Http\Controllers\Admin\FieldMonsterCrudController;
use App\Models\Monster;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = FieldMonsterCrudController::class;
    public string $model = Monster::class;
    public string $route = 'field-monster';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = []; 
}
