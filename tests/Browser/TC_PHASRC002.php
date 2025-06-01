<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TC_PHASRC002 extends DuskTestCase
{
    /** @test */
    public function patient_can_search_for_existing_medicine()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/medicines')
                    ->type('query', 'test, gaada nih')
                    ->press('Search')
                    ->pause(2000)
                    ->assertSee('No medicines available.');
        });
    }
}
