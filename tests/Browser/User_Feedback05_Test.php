<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class User_Feedback05_Test extends DuskTestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function testSubmitAppointmentServiceFeedbackWithRatingAndComment(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/reviews')
                ->select('#reviewSelector', 'appointment') 
                ->pause(500)
                ->select('#doctorSelector', 'Dr.David Indra Yuana') 
                ->pause(500)
                ->click('.star[data-value="5"]')
                ->pause(300)
                ->type('#reviewTextarea', 'Doctor was very attentive and helpful during my appointment.')
                ->press('#submitBtn')
                ->pause(1000)
                ->waitForText('Thank you for your review!', 5)
                ->assertSee('Thank you for your review!');
        });
    }
}
