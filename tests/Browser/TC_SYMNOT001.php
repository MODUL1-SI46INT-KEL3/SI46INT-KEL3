<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TC_SYMNOT001 extends DuskTestCase
{
    /** @test */
    public function patient_selects_invalid_number_of_symptoms_receive_notification()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/symptoms')
                    ->check('#symptom-4')
                    ->press('Get Recommendation')
                    ->pause(2000)
                    ->assertSee('The symptoms field must have at least 2 items.'); // adjust text as needed
        });
    }
}
