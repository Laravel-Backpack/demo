<?php

namespace Tests\Feature\Admin\FluentMonsterCrud;

use App\Http\Controllers\Admin\FluentMonsterCrudController;
use App\Models\Monster;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class FluentMonsterCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = FluentMonsterCrudController::class;
    protected string $route = 'fluent-monster';
    protected string $model = Monster::class;
    protected ?string $entityName = 'fluent monster';
    protected ?string $entityNamePlural = 'fluent monsters';
    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->testHelper->actingAsAdmin($this);
    }
}
