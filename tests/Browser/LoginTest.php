<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class LoginTest extends DuskTestCase
{
    public function test_login_form_logs_user_in()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login');
            $browser->press('Login');
            $browser->assertPathIs('/admin/dashboard');
        });
    }
}