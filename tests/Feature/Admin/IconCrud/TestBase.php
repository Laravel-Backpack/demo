<?php

namespace Tests\Feature\Admin\IconCrud;

use App\Http\Controllers\Admin\IconCrudController;
use App\Models\Icon;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = IconCrudController::class;
    public string $model = Icon::class;
    public string $route = 'icon';
    public ?string $entityName = 'icon';
    public ?string $entityNamePlural = 'icons';
}
