<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TC_SYMADD002 extends DuskTestCase
{
    /** @test */
    public function admin_cannot_add_symptom_without_name()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/adminsymptoms/create')
                    ->type('name', '') // Empty name
                    ->select('specializations[]', 1)
                    ->press('Save Symptom')
                    ->pause(3000)
                    ->assertSee('The name field is required.');
        });
    }
}
