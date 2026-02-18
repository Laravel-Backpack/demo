<?php

namespace Tests\Feature\Admin\PetShop\PetCrud;

class UpdateTest extends TestBase
{
    use \Tests\Feature\Backpack\DefaultUpdateTests;

     public function setUp(): void
    {
        parent::setUp();

        $this->updateInput = array_merge($this->model::factory()->make()->toArray(), [
            'avatar' => [
                'url' => 'https://lorempixel.com/400/200/animals',
            ],
        ]);
    }
}
