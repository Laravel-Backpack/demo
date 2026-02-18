<?php

namespace Tests\Feature\Admin\FluentMonsterCrud;

use App\Http\Controllers\Admin\FluentMonsterCrudController;
use App\Models\Monster;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = FluentMonsterCrudController::class;
    public string $model = Monster::class;
    public string $route = 'fluent-monster';
    public ?string $entityName = 'fluent monster';
    public ?string $entityNamePlural = 'fluent monsters';
}
