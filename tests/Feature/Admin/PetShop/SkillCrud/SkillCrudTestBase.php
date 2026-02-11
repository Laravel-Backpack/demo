<?php

namespace Tests\Feature\Admin\PetShop\SkillCrud;

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
        $this->testHelper->actingAsAdmin($this);
    }
}
