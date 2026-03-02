<?php

namespace Tests\Feature\Admin;

use App\Http\Controllers\Admin\FieldMonsterCrudController;
use App\Models\Monster;

class FieldMonsterCrudControllerTest extends \Tests\Feature\Backpack\DefaultTestBase
{
    use \Tests\Feature\Backpack\DefaultListTests;
    use \Tests\Feature\Backpack\DefaultCreateTests;
    use \Tests\Feature\Backpack\DefaultUpdateTests;
    use \Tests\Feature\Backpack\DefaultDeleteTests;
    use \Tests\Feature\Backpack\DefaultShowTests;

    public string $controller = FieldMonsterCrudController::class;
    public string $model = Monster::class;
    public string $route = 'field-monster';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = []; 
}
