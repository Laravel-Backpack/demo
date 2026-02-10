<?php

namespace Tests\Feature\PassportCrud;

class DeleteTest extends PassportCrudTestBase
{
    public string $operation = 'delete';
    /**
     * Test that entry can be deleted
     */
    public function test_delete_removes_entry_from_database(): void
    {
        $this->markTestSkipped('Factory not found for model ' . $this->model);
        $entry = $this->createTestEntry();
        
        $response = $this->delete($this->getCrudUrl($entry->getKey()));
        
        $response->assertStatus(200);
        
        // Assert entry is missing from database
        $this->assertDatabaseMissing($this->model, [$entry->getKeyName() => $entry->getKey()]);
    }

}
