<?php

namespace Tests\Browser\Auth;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ForgotPasswordTest extends DuskTestCase
{
    public function test_form_submits()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/password/reset');
            $browser->assertSee('Confirm Email');
            $browser->type('email', 'admin@example.com');
            $browser->press('Send Password Reset Link');
            $browser->assertPathIs('/admin/password/reset');
            $browser->assertSee('We have e-mailed your password reset link!');
        });
    }

    // TODO:
    // public function test_inexisting_email_submitted()
    // public function test_non_email_submitted()
    // public function test_email_contains_link() {}
    // public function test_email_link_opens_page() {}
    // public function test_reset_password_form_submits() {}
    // public function test_login_after_password_reset() {}
}
