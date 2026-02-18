<?php

namespace Tests\Feature\Admin\MonsterCrud;

class CreateTest extends TestBase
{
    use \Tests\Feature\Backpack\DefaultCreateTests;

    public function setup(): void
    {
        parent::setUp();

        $this->createInput = array_merge($this->model::factory()->make()->toArray(), [
            'icondummy' => 1,
        ]);

        $this->assertCreateInput = array_merge($this->testHelper->getDatabaseAssertInput($this->model, $this->createInput), [
            'belongs_to_non_nullable' => 1,
        ]);
    }
}
