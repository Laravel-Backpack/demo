<?php

namespace Tests\Feature\Admin\StoryCrud;

use App\Http\Controllers\Admin\StoryCrudController;
use App\Models\Story;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = StoryCrudController::class;
    public string $model = Story::class;
    public string $route = 'story';
    public ?string $entityName = 'story';
    public ?string $entityNamePlural = 'stories';
}
