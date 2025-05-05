<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UpdMedTest extends DuskTestCase
{
    /**
     * Test admin can add a new medicine
     */
    public function test_admin_can_upd_medicine()
    {
        $this->browse(function (Browser $browser) {
            // Visit the admin login page
            $browser->visit('/adminmedicine/4/edit')

                // Fill in the form with clear + type to ensure overwrite
                ->type('medicine_name', 'Arsitam')
                ->type('description', 'for TB')
                ->type('price', '32000')
                ->type('stock', '54')

                ->screenshot('before-submit') // Screenshot before clicking save

                // Submit the form
                ->press("Update Medicine");
        });
    }
}