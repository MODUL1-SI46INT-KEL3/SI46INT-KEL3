<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class User_Feedback10_Test extends DuskTestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function testMedicinePurchaseFeedbackWithRatingAndComments(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/reviews')
                ->select('#reviewSelector', 'shop')
                ->pause(500)
                ->click('.star[data-value="4"]')
                ->pause(300)
                ->type('#reviewTextarea', 'Medicine arrived on time and was well-packaged.')
                ->press('#submitBtn')
                ->pause(1000)

                ->assertSee('Thank you for your review!');
        });
    }
}
