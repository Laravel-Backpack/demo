<?php

namespace Tests\Feature\Admin\UserCrud;

class CreateTest extends TestBase
{
    use \Tests\Feature\Backpack\DefaultCreateTests;

    public function setUp(): void
    {
        parent::setUp();
        $user = $this->model::factory()->raw();
        $this->createInput = array_merge($user, ['password_confirmation' => $user['password']]);

        $assertion = $this->testHelper->getDatabaseAssertInput($this->model, $this->createInput);
        unset($assertion['password']);
        unset($assertion['password_confirmation']);

        $this->assertCreateInput = $assertion;
    }
}
