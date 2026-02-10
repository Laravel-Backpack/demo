<?php

namespace Tests\Feature\SkillCrud;

use App\Http\Controllers\Admin\PetShop\SkillCrudController;
use App\Models\PetShop\Skill;
use Backpack\CRUD\app\Library\CrudTesting\CrudFeatureTestCase;

class SkillCrudTestBase extends CrudFeatureTestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    protected string $controller = SkillCrudController::class;
    protected string $route = 'pet-shop/skill';
    protected string $model = Skill::class;
    protected ?string $entityName = 'skill';
    protected ?string $entityNamePlural = 'skills';
    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAsAdmin();

        // Clear filters to avoid duplication conflict when the request is run
        if ($this->app->bound('crud')) {
            $this->app['crud']->clearFilters();
        }

        if(config('backpack.testing.configurations.'.$this->controller)) {
            $this->testConfig = new (config('backpack.testing.configurations.'.$this->controller))();
        }
    }
}
