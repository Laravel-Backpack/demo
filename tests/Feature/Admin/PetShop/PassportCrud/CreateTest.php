<?php

namespace Tests\Feature\Admin\PetShop\PassportCrud;

class CreateTest extends TestBase
{
    use \Tests\Feature\Backpack\DefaultCreateTests;

    public function setUp(): void
    {
        parent::setUp();

        $this->createInput = array_merge($this->model::factory()->make()->toArray(), [
            'pet' => 1
        ]);
    }
}
