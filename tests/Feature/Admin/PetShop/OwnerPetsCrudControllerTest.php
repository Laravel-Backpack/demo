<?php

namespace Tests\Feature\Admin\PetShop;

use App\Http\Controllers\Admin\PetShop\OwnerPetsCrudController;

class OwnerPetsCrudControllerTest extends \Tests\Feature\Backpack\DefaultTestBase
{
    use \Tests\Feature\Backpack\DefaultListTests;
    use \Tests\Feature\Backpack\DefaultCreateTests;
    use \Tests\Feature\Backpack\DefaultShowTests {
        test_show_page_loads_successfully as default_test_show_page_loads_successfully;
    }
    use \Tests\Feature\Backpack\DefaultUpdateTests {
        test_update_page_loads_successfully as default_test_update_page_loads_successfully;
    }

    public string $controller = OwnerPetsCrudController::class;
    public string $route = 'pet-shop/owner/1/pets';
    public string $model = \App\Models\PetShop\Pet::class;
    // Pass additional parameters to controller routes. eg. ['owner' => 1]
    public array $routeParameters = ['owner' => 1]; 

    public function setup(): void
    {
        parent::setUp();

        $this->createInput = $this->updateInput = array_merge($this->model::factory()->make()->toArray(), [
            'avatar' => [
                'url' => 'https://lorempixel.com/400/200/animals',
            ],
        ]);

        \App\Models\PetShop\Owner::factory()->create(['id' => 1]); // create an owner with id 1
    }

    /**
     * Test logic for update operation.
     */
    public function test_update_page_loads_successfully(): void
    {
        $this->skipIfModelDoesNotHaveFactory();

        $entry = $this->model::factory()->create();

        $entry->owners()->attach(1, ['role' => 'Owner']); // attach the pet to the owner with id 1
        $entry->save();

        $response = $this->get($this->testHelper->getCrudUrl($entry->getKey().'/edit'));
        $response->assertStatus(200);
        $response->assertSee($this->entityName ?? '');
    }

       /**
     * Test logic for show operation.
     */
    public function test_show_page_loads_successfully(): void
    {
        $this->skipIfModelDoesNotHaveFactory();

        $entry = $this->model::factory()->create();

        $entry->owners()->attach(1, ['role' => 'Owner']); // attach the pet to the owner with id 1
        $entry->save();

        $response = $this->get($this->testHelper->getCrudUrl($entry->getKey().'/show'));
        $response->assertStatus(200);
        $response->assertSee($this->entityName ?? '');
    }
}
