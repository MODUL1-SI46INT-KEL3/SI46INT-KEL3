<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class User_Feedback06_Test extends DuskTestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function testSubmitAppointmentFeedbackWithoutDoctorSelection(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/reviews')
                ->select('#reviewSelector', 'appointment')
                ->pause(500)
                ->click('.star[data-value="4"]')
                ->pause(300)
                ->type('#reviewTextarea', 'Good experience, but forgot to choose a doctor.')
                ->press('#submitBtn')
                ->pause(1000);

            $browser->assertSee('Doctor selection is required'); 
        });
    }
}
