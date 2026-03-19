<?php

namespace Tests\Feature\Admin\PetShop;

use App\Http\Controllers\Admin\PetShop\PassportCrudController;
use App\Models\PetShop\Passport;

class PassportCrudControllerTest extends \Tests\Feature\Backpack\DefaultTestBase
{
    use \Tests\Feature\Backpack\DefaultListTests;
    use \Tests\Feature\Backpack\DefaultCreateTests;
    use \Tests\Feature\Backpack\DefaultUpdateTests;
    use \Tests\Feature\Backpack\DefaultDeleteTests;
    use \Tests\Feature\Backpack\DefaultShowTests;

    public string $controller = PassportCrudController::class;
    public string $model = Passport::class;
    public string $route = 'pet-shop/passport';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = [];

    public function setup(): void
    {
        parent::setUp();

        $this->createInput = $this->updateInput = array_merge($this->model::factory()->make()->toArray(), [
            'pet' => 1,
        ]);
    }
}
