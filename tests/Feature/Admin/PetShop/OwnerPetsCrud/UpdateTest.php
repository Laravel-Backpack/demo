<?php

namespace Tests\Feature\Admin\PetShop\OwnerPetsCrud;

class UpdateTest extends TestBase
{
    use \Tests\Feature\Backpack\DefaultUpdateTests {
        test_update_page_loads_successfully as default_test_update_page_loads_successfully;
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->updateInput = array_merge($this->model::factory()->make()->toArray(), [
            'avatar' => [
                'url' => 'https://lorempixel.com/400/200/animals',
            ],
        ]);
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
}
