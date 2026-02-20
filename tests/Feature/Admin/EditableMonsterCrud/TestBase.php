<?php

namespace Tests\Feature\Admin\EditableMonsterCrud;

use App\Http\Controllers\Admin\EditableMonsterCrudController;
use App\Models\Monster;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = EditableMonsterCrudController::class;
    public string $model = Monster::class;
    public string $route = 'editable-monster';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = [];
}
