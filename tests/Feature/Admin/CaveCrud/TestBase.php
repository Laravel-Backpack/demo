<?php

namespace Tests\Feature\Admin\CaveCrud;

use App\Http\Controllers\Admin\CaveCrudController;
use App\Models\Cave;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = CaveCrudController::class;
    public string $model = Cave::class;
    public string $route = 'cave';
    public ?string $entityName = 'cave';
    public ?string $entityNamePlural = 'caves';
}
