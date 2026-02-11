<?php

namespace Tests\Feature\Admin\HeroCrud;

use App\Http\Controllers\Admin\HeroCrudController;
use App\Models\Hero;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class HeroCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = HeroCrudController::class;
    protected string $route = 'hero';
    protected string $model = Hero::class;
    protected ?string $entityName = 'hero';
    protected ?string $entityNamePlural = 'heroes';
    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->testHelper->actingAsAdmin($this);
    }
}
