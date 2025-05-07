<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateScheduleTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->visit('/adminschedules/create')
                ->select('doctor_id', $doctor->id)
                ->select('patient_id', $patient->id)
                ->type('date', now()->toDateString())
                ->type('time', '10:00')
                ->select('status', 'Scheduled')
                ->press('Submit')
                ->assertPathIs('/adminschedules')
                ->assertSee('Schedule created successfully');
        });
    }
}
