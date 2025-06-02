<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TC_SYMUPD002 extends DuskTestCase
{
    /** @test */
    public function admin_cannot_edit_new_symptom_without_name()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/adminsymptoms/25/edit')
                    ->type('name', '')
                    ->select('specializations[]', 1)
                    ->press('Update Symptom')
                    ->pause(3000)
                    ->assertSee('Please fill out this field.');
        });
    }
}
