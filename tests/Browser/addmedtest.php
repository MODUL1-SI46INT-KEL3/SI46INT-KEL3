<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AddMedTest extends DuskTestCase
{
    /**
     * Test admin can add a new medicine
     */
    public function test_admin_can_add_new_medicine()
    {
        $this->browse(function (Browser $browser) {
            // Visit the admin login page
            $browser->visit('/adminmedicine/create')

                // Fill in the form with clear + type to ensure overwrite
                ->type('medicine_name', 'Panadol')
                ->type('#description', 'Pain reliever medication')
                ->type('#price', '15000')
                ->type('#stock', '50')

                ->screenshot('before-submit') // Screenshot before clicking save

                // Submit the form
                ->press('Save Medicine');
        });
    }
}