<?php

namespace Tests\Feature\Admin\UserCrud;

use App\Http\Controllers\Admin\UserCrudController;
use App\User;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class UserCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = UserCrudController::class;
    protected string $route = 'user';
    protected string $model = User::class;
    protected ?string $entityName = 'User';
    protected ?string $entityNamePlural = 'Users';
    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->testHelper->actingAsAdmin($this);
    }
}
