<?php

namespace Tests\Feature\Admin\UserCrud;

use App\Http\Controllers\Admin\UserCrudController;
use App\User;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = UserCrudController::class;
    public string $model = User::class;
    public string $route = 'user';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = [];
}
