<?php

namespace Tests\Feature\Admin\HeroCrud;

class ShowTest extends HeroCrudTestBase
{
    public string $operation = 'show';

    /**
     * Test that show page loads.
     */
    public function test_show_page_loads_successfully(): void
    {
        $entry = $this->createTestEntry();
        $response = $this->get($this->getCrudUrl($entry->getKey().'/show'));
        $response->assertStatus(200);
    }
}
