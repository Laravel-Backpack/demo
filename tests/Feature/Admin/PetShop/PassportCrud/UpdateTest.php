<?php

namespace Tests\Feature\Admin\PetShop\PassportCrud;

class UpdateTest extends TestBase
{
    use \Tests\Feature\Backpack\DefaultUpdateTests;

    public function setUp(): void
    {
        parent::setUp();

        $this->updateInput = array_merge($this->model::factory()->create()->toArray(), [
            'pet' => 1
        ]);
    }
}
