<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Appointment_Booking_003 extends DuskTestCase
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

                    ->select('specialization_id', '1')
                    ->pause(2000)
                    ->waitUsing(5, 100, function () use ($browser) {
                        return !$browser->element('#doctor_id')->getAttribute('disabled');
                    })
                    ->select('doctor_id', '1')
                    ->script("document.getElementById('doctor_id').dispatchEvent(new Event('change', { bubbles: true }));")
                    ->press('Next')
                    ->assertPathIs('/appointments/step2')
                    
                    ->assertSee('Select Date & Time')

                    ->assertAttribute('#submit-btn', 'disabled', 'true')

                    ->assertPresent('input[name="schedule_id"]')
                    
                    ->radio('schedule_id', '1') 

                    ->script("document.querySelector('input[name=\"schedule_id\"]:checked').dispatchEvent(new Event('change', { bubbles: true }));")
                    ->pause(500)

                    ->assertMissing('#submit-btn[disabled]')

                    ->press('Next')

                    ->assertPathIs('/appointments/step3');
        });
    }
}
