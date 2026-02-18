<?php

namespace Tests\Feature\Admin\PetShop\SkillCrud;

use App\Http\Controllers\Admin\PetShop\SkillCrudController;
use App\Models\PetShop\Skill;

class TestBase extends \Tests\Feature\Backpack\DefaultTestBase
{
    public string $controller = SkillCrudController::class;
    public string $model = Skill::class;
    public string $route = 'pet-shop/skill';
    public ?string $entityName = 'skill';
    public ?string $entityNamePlural = 'skills';
}
