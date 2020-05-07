<?php

namespace Tests\Browser;

use Facebook\WebDriver\WebDriverBy;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PageCrudTest extends DuskTestCase
{
    public function test_cannot_access_list_operation_without_login()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/page');
            $browser->assertPathIs('/admin/login');
        });
    }

    public function test_page_crud_list_operation()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login');
            $browser->press('Login');
            $browser->clickLink('Pages');
            $browser->waitForText('Showing');
            $browser->assertSee('Showing');

            // count the number of rows in the table tbody
            $elements = $browser->driver->findElements(WebDriverBy::cssSelector('#crudTable tbody tr'));

            $this->assertCount(10, $elements);
        });
    }
}
