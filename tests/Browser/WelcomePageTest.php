<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class WelcomePageTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function test_welcome_page_opens_fine()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('No front-end pages are provided in this demo');
        });
    }
}
