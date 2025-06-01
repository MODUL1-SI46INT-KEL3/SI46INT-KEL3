<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TC_SYMUPD001 extends DuskTestCase
{
    /** @test */
    public function admin_can_edit_new_symptom_successfully()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/adminsymptoms/25/edit')
                    ->type('name', 'Fever Hot')
                    ->select('specializations[]', 1)
                    ->press('Update Symptom')
                    ->pause(3000)
                    ->assertSee('Fever Hot');
        });
    }
}
