<?php

namespace Tests\Feature\Admin\MeetingCrud;

use App\Http\Controllers\Admin\MeetingCrudController;
use App\Models\Meeting;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = MeetingCrudController::class;
    public string $model = Meeting::class;
    public string $route = 'meeting';
    public ?string $entityName = 'meeting';
    public ?string $entityNamePlural = 'meetings';
}
