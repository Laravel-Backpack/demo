<?php

namespace Tests\Feature\Admin\MeetingCrud;

use App\Http\Controllers\Admin\MeetingCrudController;
use App\Models\Meeting;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = MeetingCrudController::class;
    public string $model = Meeting::class;
    public string $route = 'meeting';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = [];
}
