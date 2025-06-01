<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class User_Feedback08_Test extends DuskTestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function testAppointmentFeedbackWithoutRating(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/reviews')
                ->select('#reviewSelector', 'appointment')
                ->pause(500)
                ->select('#doctorSelector', 'Dr.David Indra Yuana')
                ->pause(300)
                ->type('#reviewTextarea', 'Doctor was kind and professional.')
                ->press('#submitBtn')
                ->pause(1000);

            $browser->assertSee('Rating is required'); 
        });
    }
}
