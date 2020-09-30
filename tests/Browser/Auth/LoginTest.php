<?php

namespace Tests\Browser\Auth;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

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
