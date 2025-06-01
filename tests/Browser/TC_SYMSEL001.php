<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TC_SYMSEL001 extends DuskTestCase
{
    /** @test */
    public function patient_selects_valid_number_of_symptoms()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/symptoms')
                    ->check('#symptom-3')
                    ->check('#symptom-4')
                    ->press('Get Recommendation')
                    ->pause(2000)
                    ->assertSee('Recommended Specializations'); // adjust text as needed
        });
    }
}
