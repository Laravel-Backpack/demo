<?php

namespace Tests\Feature\Admin\FieldMonsterCrud;

class DeleteTest extends FieldMonsterCrudTestBase
{
    public string $operation = 'delete';
    /**
     * Test that entry can be deleted
     */
    public function test_delete_removes_entry_from_database(): void
    {
        
        $entry = $this->testHelper->createEntry();
        
        $response = $this->delete($this->testHelper->getCrudUrl($entry->getKey()));
        
        $response->assertStatus(200);
        
        // Assert entry is missing from database
        $this->assertDatabaseMissing($this->model, [$entry->getKeyName() => $entry->getKey()]);
        
    }

}
