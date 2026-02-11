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
        $this->testHelper->actingAsAdmin($this);
    }
}
