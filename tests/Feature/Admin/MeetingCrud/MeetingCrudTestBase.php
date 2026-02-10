<?php

namespace Tests\Feature\Admin\MeetingCrud;

use App\Http\Controllers\Admin\MeetingCrudController;
use App\Models\Meeting;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class MeetingCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = MeetingCrudController::class;
    protected string $route = 'meeting';
    protected string $model = Meeting::class;
    protected ?string $entityName = 'meeting';
    protected ?string $entityNamePlural = 'meetings';
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
