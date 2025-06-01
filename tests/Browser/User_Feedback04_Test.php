<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class User_Feedback04_Test extends DuskTestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function testSubmitWebsiteFeedbackWithCommentsOnly(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/reviews')
                ->select('#reviewSelector', 'web') 
                ->pause(500)
                ->type('#reviewTextarea', 'The website layout is clean and informative.')
                ->press('#submitBtn')
                ->pause(1000);

            $browser->assertSee('Rating is required'); 
        });
    }
}
