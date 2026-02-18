<?php

namespace Tests\Feature\Admin\PetShop\PetCrud;

class CreateTest extends TestBase
{
    use \Tests\Feature\Backpack\DefaultCreateTests;

     public function setUp(): void
    {
        parent::setUp();

        $this->createInput = array_merge($this->model::factory()->make()->toArray(), [
            'avatar' => [
                'url' => 'https://lorempixel.com/400/200/animals',
            ],
        ]);
    }
}
