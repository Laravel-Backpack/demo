<?php

namespace Tests\Feature\Admin\ColumnMonsterCrud;

use App\Http\Controllers\Admin\ColumnMonsterCrudController;
use App\Models\Monster;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = ColumnMonsterCrudController::class;
    public string $model = Monster::class;
    public string $route = 'column-monster';
    public ?string $entityName = 'column monster';
    public ?string $entityNamePlural = 'column monsters';
}
