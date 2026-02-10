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
        $this->actingAsAdmin();

        // Clear filters to avoid duplication conflict when the request is run
        if ($this->app->bound('crud')) {
            $this->app['crud']->clearFilters();
        }

        if (config('backpack.testing.configurations.'.$this->controller)) {
            $this->testConfig = new (config('backpack.testing.configurations.'.$this->controller))();
        }
    }
}
