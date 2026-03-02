<?php

namespace Tests\Feature\Admin;

use App\Http\Controllers\Admin\DummyCrudController;
use App\Models\Dummy;

class DummyCrudControllerTest extends \Tests\Feature\Backpack\DefaultTestBase
{
    use \Tests\Feature\Backpack\DefaultListTests;
    use \Tests\Feature\Backpack\DefaultCreateTests;
    use \Tests\Feature\Backpack\DefaultUpdateTests;
    use \Tests\Feature\Backpack\DefaultDeleteTests;
    use \Tests\Feature\Backpack\DefaultShowTests;

    public string $controller = DummyCrudController::class;
    public string $model = Dummy::class;
    public string $route = 'dummy';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = []; 
}
