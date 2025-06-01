<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Appointment_Booking_002 extends DuskTestCase
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
                    ->type('email', 'abd@gmail.com')
                    ->type('password', '12345678')
                    ->press('Login')
                    ->press('Book Appointment >')
                    ->assertPathIs('/appointments/step1')
                    ->select('specialization_id', '')
                    ->select('doctor_id', '')
                    ->press('Next')
                    ->assertPathIs('/appointments/step2');
        });
    }
}
