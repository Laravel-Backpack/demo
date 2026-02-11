<?php

namespace Tests\Feature\Admin\PetShop\BadgeCrud;

class ShowTest extends BadgeCrudTestBase
{
    public string $operation = 'show';

    /**
     * Test that show page loads
     */
    public function test_show_page_loads_successfully(): void
    {
        $this->markTestSkipped('Factory not found for model ' . $this->model);
        $entry = $this->testHelper->createEntry();
        $response = $this->get($this->testHelper->getCrudUrl($entry->getKey().'/show'));
        $response->assertStatus(200);
    }

}
