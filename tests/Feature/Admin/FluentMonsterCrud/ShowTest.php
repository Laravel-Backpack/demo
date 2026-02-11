<?php

namespace Tests\Feature\Admin\FluentMonsterCrud;

class ShowTest extends FluentMonsterCrudTestBase
{
    public string $operation = 'show';

    /**
     * Test that show page loads.
     */
    public function test_show_page_loads_successfully(): void
    {
        $entry = $this->testHelper->createEntry();
        $response = $this->get($this->testHelper->getCrudUrl($entry->getKey().'/show'));
        $response->assertStatus(200);
    }
}
