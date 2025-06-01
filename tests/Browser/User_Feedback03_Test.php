<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class User_Feedback03_Test extends DuskTestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function testSubmitWithoutRating(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/reviews')
                ->select('#reviewSelector', 'web') 
                ->pause(500)
                ->type('#reviewTextarea', 'Feedback without selecting a rating')
                ->press('#submitBtn')
                ->pause(1000) 
                ->assertSee('Rating is required'); 
        });
    }
}
