<?php

namespace Tests\Feature\Admin\DummyCrud;

use App\Http\Controllers\Admin\DummyCrudController;
use App\Models\Dummy;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = DummyCrudController::class;
    public string $model = Dummy::class;
    public string $route = 'dummy';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = []; 
}
