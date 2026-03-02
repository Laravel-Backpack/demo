<?php

namespace Tests\Feature\Admin;

use App\Http\Controllers\Admin\UserCrudController;
use App\User;

class UserCrudControllerTest extends \Tests\Feature\Backpack\DefaultTestBase
{
    use \Tests\Feature\Backpack\DefaultListTests;
    use \Tests\Feature\Backpack\DefaultCreateTests;
    use \Tests\Feature\Backpack\DefaultUpdateTests;
    use \Tests\Feature\Backpack\DefaultDeleteTests;
    use \Tests\Feature\Backpack\DefaultShowTests;

    public string $controller = UserCrudController::class;
    public string $model = User::class;
    public string $route = 'user';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = [];

    public function setup(): void
    {
        parent::setUp();

        $user = $this->model::factory()->raw();
        $this->createInput = $this->updateInput = array_merge($user, ['password_confirmation' => $user['password']]);

        $assertion = $this->testHelper->getDatabaseAssertInput($this->model, $this->createInput);
        unset($assertion['password']);
        unset($assertion['password_confirmation']);

        $this->assertCreateInput = $this->assertUpdateInput = $assertion;
    }
}
