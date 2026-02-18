<?php

namespace Tests\Feature\Admin\UserCrud;

use App\Http\Controllers\Admin\UserCrudController;
use App\User;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = UserCrudController::class;
    public string $model = User::class;
    public string $route = 'user';
    public ?string $entityName = 'User';
    public ?string $entityNamePlural = 'Users';
}
