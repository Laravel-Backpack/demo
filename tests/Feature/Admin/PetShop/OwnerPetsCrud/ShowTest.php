<?php

namespace Tests\Feature\Admin\PetShop\OwnerPetsCrud;

class ShowTest extends TestBase
{
    /**
     * Test logic for show operation
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
