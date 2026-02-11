<?php

namespace Tests\Feature\Admin\DummyCrud;

use App\Http\Controllers\Admin\DummyCrudController;
use App\Models\Dummy;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class DummyCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = DummyCrudController::class;
    protected string $route = 'dummy';
    protected string $model = Dummy::class;
    protected ?string $entityName = 'dummy';
    protected ?string $entityNamePlural = 'dummies';
    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->testHelper->actingAsAdmin($this);
    }
}
