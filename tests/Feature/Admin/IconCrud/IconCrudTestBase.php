<?php

namespace Tests\Feature\Admin\IconCrud;

use App\Http\Controllers\Admin\IconCrudController;
use App\Models\Icon;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class IconCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = IconCrudController::class;
    protected string $route = 'icon';
    protected string $model = Icon::class;
    protected ?string $entityName = 'icon';
    protected ?string $entityNamePlural = 'icons';
    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->testHelper->actingAsAdmin($this);
    }
}
