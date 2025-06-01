<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class User_Feedback12_Test extends DuskTestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function testMedicinePurchaseFeedbackWithoutRating(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/reviews')
                ->select('#reviewSelector', 'shop') 
                ->pause(500)
                ->type('#reviewTextarea', 'Helpful experience with online pharmacy.') 
                ->press('#submitBtn')
                ->pause(1000)
                ->assertSee('Rating is required');
        });
    }
}
