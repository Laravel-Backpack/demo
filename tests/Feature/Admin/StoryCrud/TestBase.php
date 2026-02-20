<?php

namespace Tests\Feature\Admin\StoryCrud;

use App\Http\Controllers\Admin\StoryCrudController;
use App\Models\Story;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = StoryCrudController::class;
    public string $model = Story::class;
    public string $route = 'story';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = [];
}
