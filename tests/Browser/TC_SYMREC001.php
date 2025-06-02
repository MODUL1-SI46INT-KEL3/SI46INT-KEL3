<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TC_SYMREC001 extends DuskTestCase
{
    /** @test */
    public function patient_selects_valid_number_of_symptoms_receive_correct_recommendation()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/symptoms')
                    ->check('#symptom-4')
                    ->check('#symptom-5')
                    ->press('Get Recommendation')
                    ->pause(2000)
                    ->assertSee('Cardiology'); // adjust text as needed
        });
    }
}
