<?php

namespace Tests\Feature\Admin;

use App\Http\Controllers\Admin\ColumnMonsterCrudController;
use App\Models\Monster;

class ColumnMonsterCrudControllerTest extends \Tests\Feature\Backpack\DefaultTestBase
{
    use \Tests\Feature\Backpack\DefaultListTests;
    use \Tests\Feature\Backpack\DefaultCreateTests;
    use \Tests\Feature\Backpack\DefaultUpdateTests;
    use \Tests\Feature\Backpack\DefaultDeleteTests;
    use \Tests\Feature\Backpack\DefaultShowTests;

    public string $controller = ColumnMonsterCrudController::class;
    public string $model = Monster::class;
    public string $route = 'column-monster';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = []; 
}
