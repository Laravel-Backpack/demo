<?php

namespace Tests\Feature\Admin\PetShop;

use App\Http\Controllers\Admin\PetShop\PetCrudController;
use App\Models\PetShop\Pet;

class PetCrudControllerTest extends \Tests\Feature\Backpack\DefaultTestBase
{
    use \Tests\Feature\Backpack\DefaultListTests;
    use \Tests\Feature\Backpack\DefaultCreateTests;
    use \Tests\Feature\Backpack\DefaultUpdateTests;
    use \Tests\Feature\Backpack\DefaultShowTests;

    public string $controller = PetCrudController::class;
    public string $model = Pet::class;
    public string $route = 'pet-shop/pet';
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = [];

    public function setup(): void
    {
        parent::setUp();

        $this->createInput = $this->updateInput = array_merge($this->model::factory()->make()->toArray(), [
            'avatar' => [
                'url' => 'https://lorempixel.com/400/200/animals',
            ],
        ]);
    }
}
