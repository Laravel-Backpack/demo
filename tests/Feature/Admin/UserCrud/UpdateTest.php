<?php

namespace Tests\Feature\Admin\UserCrud;

class UpdateTest extends TestBase
{
    use \Tests\Feature\Backpack\DefaultUpdateTests;

    public function setUp(): void
    {
        parent::setUp();
        $user = $this->model::factory()->raw();
        $this->updateInput = array_merge($user, ['password_confirmation' => $user['password']]);

        $assertion = $this->testHelper->getDatabaseAssertInput($this->model, $this->updateInput);
        unset($assertion['password']);
        unset($assertion['password_confirmation']);

        $this->assertUpdateInput = $assertion;
    }
}
