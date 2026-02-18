<?php

namespace Tests\Feature\Admin\MonsterCrud;

use App\Http\Controllers\Admin\MonsterCrudController;
use App\Models\Monster;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = MonsterCrudController::class;
    public string $model = Monster::class;
    public string $route = 'monster';
    public ?string $entityName = 'monster';
    public ?string $entityNamePlural = 'monsters';
}
