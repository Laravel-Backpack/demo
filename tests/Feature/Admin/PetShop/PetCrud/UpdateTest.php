<?php

namespace Tests\Feature\Admin\PetShop\PetCrud;

class UpdateTest extends PetCrudTestBase
{
    public string $operation = 'update';
    
    /**
     * Test that the update page loads without errors
     */
    public function test_update_page_loads_successfully(): void
    {
        $this->markTestSkipped('Factory not found for model ' . $this->model);
        $entry = $this->testHelper->createEntry();
        $response = $this->get($this->testHelper->getCrudUrl($entry->getKey().'/edit'));
        $response->assertStatus(200);
        $response->assertSee($this->entityName ?? '');

        $fields = $this->testHelper->getOperationSetting('fields', []);
        foreach ($fields as $field) {
            $response->assertSee('name="'.$field['name'].'"', false);
        }
    }

    /**
     * Test that entry is updated in the database
     */
    public function test_update_endpoint_updates_entry_in_database(): void
    {
        $this->markTestSkipped('Factory not found for model ' . $this->model);
        $entry = $this->testHelper->createEntry();
        $data = $this->testHelper->validUpdateInput($this->model);

        $data[$entry->getKeyName()] = $entry->getKey();
        $response = $this->put($this->testHelper->getCrudUrl($entry->getKey()), $data);
        
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);

        $this->assertDatabaseHas($this->model, $this->testHelper->getDatabaseAssertInput($this->model, $data));
    }

    /**
     * Test that the update form validates wrong form data
     */
    public function test_update_endpoint_rejects_invalid_input(): void
    {
        $this->markTestSkipped('Factory not found for model ' . $this->model);
        $entry = $this->testHelper->createEntry();
        $data = $this->testHelper->invalidInput();

        // Submit data to trigger validation
        $response = $this->put($this->testHelper->getCrudUrl($entry->getKey()), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors();
    }

}
