<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Patient_Profiles_003 extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->press('Log In')
                    ->assertPathIs('/patients/login')
                    ->type('email', 'testpatient@gmail.com')
                    ->type('password', 'defaultPassword123')
                    ->press('Login')
                    ->assertPathIs('/patients')
                    ->click('div.profile a[href="' . route('patients.profile') . '"]')
                    ->assertPathIs('/patients/profile')
                    ->press('Edit Profile')
                    ->assertPathIs('/patients/10/edit')
                    ->type('phone', '')
                    ->press('Update Profile');
        });
    }
}
