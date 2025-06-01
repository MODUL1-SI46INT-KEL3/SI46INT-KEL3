<?php

namespace Tests\Browser;

use App\Models\Schedule;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;


class Appointment_MGT_002 extends DuskTestCase
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
                    ->clickLink('Appointment')
                    ->clickLink('Edit')
                    ->assertPathIs('/adminAppointment/35/edit')
                    ->select('schedule_id', '2025-05-31 (22:00:00 - 23:00:00)')
                    ->press('Update Appointment')
                    ->assertPathIs('/adminAppointment')
                    ->screenshot('after-schedule-select');
                    
                    
        });
    }
}
