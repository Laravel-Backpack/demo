<?php

namespace Tests\Feature\Admin\PetShop;

use App\Http\Controllers\Admin\PetShop\SkillCrudController;
use App\Models\PetShop\Skill;

class SkillCrudControllerTest extends \Tests\Feature\Backpack\DefaultTestBase
{
    use \Tests\Feature\Backpack\DefaultListTests;
    use \Tests\Feature\Backpack\DefaultCreateTests;
    use \Tests\Feature\Backpack\DefaultUpdateTests;
    use \Tests\Feature\Backpack\DefaultDeleteTests;
    use \Tests\Feature\Backpack\DefaultShowTests;

    public string $controller = SkillCrudController::class;
    public string $model = Skill::class;
    public string $route = 'pet-shop/skill';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = [];
}
