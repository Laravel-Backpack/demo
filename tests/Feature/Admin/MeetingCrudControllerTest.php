<?php

namespace Tests\Feature\Admin;

use App\Http\Controllers\Admin\MeetingCrudController;
use App\Models\Meeting;

class MeetingCrudControllerTest extends \Tests\Feature\Backpack\DefaultTestBase
{
    use \Tests\Feature\Backpack\DefaultListTests;
    use \Tests\Feature\Backpack\DefaultCreateTests;
    use \Tests\Feature\Backpack\DefaultUpdateTests;
    use \Tests\Feature\Backpack\DefaultDeleteTests;
    use \Tests\Feature\Backpack\DefaultShowTests;

    public string $controller = MeetingCrudController::class;
    public string $model = Meeting::class;
    public string $route = 'meeting';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = [];
}
