<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TC_SYMADD001 extends DuskTestCase
{
    /** @test */
    public function admin_can_add_new_symptom_successfully()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/adminsymptoms/create')
                    ->type('name', 'degdeg')
                    ->select('specializations[]', 1)
                    ->press('Save Symptom')
                    ->pause(3000)
                    ->assertSee('degdeg');
        });
    }
}
