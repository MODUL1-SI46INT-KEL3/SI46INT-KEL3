<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
//use Illuminate\Foundation\Testing\DatabaseMigrations;

class Patient_MGT_001 extends DuskTestCase
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
                    ->clickLink('Or Log In as Admin')
                    ->assertPathIs('/admins/login')
                    ->type('username', 'admin0')
                    ->type('password', '87654321')
                    ->press('Login')
                    ->assertPathIs('/admins/home')
                    ->clickLink('Patient')
                    ->assertPathIs('/adminPatient')
                    ->clickLink('Add Patient')
                    ->assertPathIs('/adminPatient/create')
                    ->type('patient_name', 'testpatient')
                    ->type('date_of_birth', '10/10/1990')
                    ->radio('gender', 'male')
                    ->type('email', 'testpatient@gmail.com')
                    ->type('phone', '081234567891')
                    ->type('address', '123 Street Name')
                    ->type('id_card', '1234567890123456')
                    ->press('Submit');
        });
    }
}
