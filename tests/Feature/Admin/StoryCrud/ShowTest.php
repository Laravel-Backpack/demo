<?php

namespace Tests\Feature\Admin\StoryCrud;

class ShowTest extends StoryCrudTestBase
{
    public string $operation = 'show';

    /**
     * Test that show page loads
     */
    public function test_show_page_loads_successfully(): void
    {
        $this->markTestSkipped('Factory not found for model ' . $this->model);
        $entry = $this->createTestEntry();
        $response = $this->get($this->getCrudUrl($entry->getKey().'/show'));
        $response->assertStatus(200);
    }

}
