<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TC_SYMADD003 extends DuskTestCase
{
    /** @test */
    public function admin_cannot_add_symptom_without_specializations()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/adminsymptoms/create')
                    ->type('name', 'hello') // Empty name
                    ->select('specializations[]', '')
                    ->press('Save Symptom')
                    ->pause(3000)
                    ->assertSee('The specializations field is required.');
        });
    }
}
