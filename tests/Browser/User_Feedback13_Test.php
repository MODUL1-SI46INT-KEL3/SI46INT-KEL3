<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class User_Feedback13_Test extends DuskTestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function testMedicinePurchaseFeedbackWithCommentsOnly(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/reviews')
                ->select('#reviewSelector', 'shop') 
                ->pause(500)
                ->type('#reviewTextarea', 'The checkout process was smooth, but no star rating given.') 
                ->press('#submitBtn')
                ->pause(1000)
                ->assertSee('Rating is required');
        });
    }
}
