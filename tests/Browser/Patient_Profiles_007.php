<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Patient_Profiles_007 extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/patients')
                    ->click('div.profile a[href="' . route('patients.profile') . '"]')
                    ->assertPathIs('/patients/login');
        });
    }
}
