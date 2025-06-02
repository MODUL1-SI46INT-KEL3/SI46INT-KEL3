<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TC_PHASEE001 extends DuskTestCase
{
    /** @test */
    public function patient_can_browse_medicines_on_pharmacy_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/medicines')
                    ->pause(2000)
                    ->assertSee('MEDICINE') 
                    ->assertSee('ibuprofen')
                    ->assertSee('Stock')
                    ->assertSee('50mg'); // this is the desc
        });
    }
}
